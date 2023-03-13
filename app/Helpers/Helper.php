<?php
namespace App\Helpers;
use Closure;
use Illuminate\Http\Request;

// Images
use Image;
use Intervention\Image\Constraint;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\Config;

// Models
use App\Models\Venture;
use App\Models\VentureListing;
use App\Models\UserVentureListing;
use App\Models\VentureCommit;
use App\Models\VentureRental;
use App\Models\VentureOwnership;
use App\Models\PickedOption;
use App\Models\QuestionOption;
use App\Models\Communication;
use App\Models\Survey;
use App\Models\UserFilledSurvey;
use App\Models\UserRole;
use App\Models\Role;
use App\Models\User;
use App\Models\Offer;
use App\Models\BuyNow;
use App\Models\UserVentureListingr;
use App\State;


// Carbon
use Carbon\Carbon;

class Helper
{
    // Constants
    const TOATAL_UNITS = 10000;
    const FIRST_SHEET = 0;
    const OWNERSHIP_START_INDEX = 1;
    const OWNERSHIP_END_INDEX = 2;
    const OWNERSHIP_SEQUENCE_STRING_LENGTH = 5;
    const PAD_STRING_ZERO='0';
    const OPTION_ANY='Any';

    // Messages
    const MESSAGE_REQUIRED = "Following field is required.";
    const MESSAGE_INVALID = "Invalid Value";
    const SEQUENCE_CLASHED = "Ownership in clash with other records";

    /**
     * Save the uploaded image.
     *
     * @param UploadedFile $file     Uploaded file.
     * @param int          $maxWidth
     * @param string       $path
     * @param Closure      $callback Custom file naming method.
     *
     * @return string File name.
     */
    public static function saveImage(UploadedFile $file, $maxWidth = 150, $path = null, Closure $callback = null)
    {
        if (!$path) {
            $path = config('filesystems.uploads.images');
        }

        if ($callback) {
            $fileName = $callback();
        } else {
            $fileName = self::getFileName($file);
        }

        $img = self::makeImage($file);
        if($maxWidth){
            $img = self::resizeImage($img, $maxWidth);
        }
        self::uploadImage($img, $fileName, $path);

        return $fileName;
    }

    public static function hideStringLastPart($string,$numberOfCharacters)
    {
        return "xxxx".substr($string, 0, (1)*($numberOfCharacters));
    }

    public static function saveFile($file, $path)
    {

        $fileName = self::getFileName($file);
        $file->move($path, $fileName);

        return $fileName;
    }

    /**
     * Get uploaded file's name.
     *
     * @param UploadedFile $file
     *
     * @return null|string
     */
    protected static function getFileName(UploadedFile $file)
    {
        $filename = $file->getClientOriginalName();
        $filename = date('Ymd_His') . '_' . strtolower(pathinfo($filename, PATHINFO_FILENAME)) . '.' . pathinfo($filename, PATHINFO_EXTENSION);

        return $filename;
    }

    /**
     * Create the image from upload file.
     *
     * @param UploadedFile $file
     *
     * @return \Intervention\Image\Image
     */
    protected static function makeImage(UploadedFile $file)
    {
        return Image::make($file);
    }

    /**
     * Resize image to the configured size.
     *
     * @param \Intervention\Image\Image $img
     * @param int                       $maxWidth
     *
     * @return \Intervention\Image\Image
     */
    protected static function resizeImage(\Intervention\Image\Image $img, $maxWidth = 150)
    {
        $img->resize($maxWidth, null, function (Constraint $constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        return $img;
    }

    /**
     * Save the uploaded image to the file system.
     *
     * @param \Intervention\Image\Image $img
     * @param string                    $fileName
     * @param string                    $path
     */
    protected static function uploadImage($img, $fileName, $path)
    {
        $img->save(public_path($path . $fileName));
    }


    public static function newVentureListingPercentage($newVentureId,$venturePrice)
    {
        $newVentureCommit= VentureCommit::where('status','!=',null)->where('new_venture_listing_id','=',$newVentureId)->sum('amount');
        $val = $newVentureCommit == 0 ? 0: ($newVentureCommit/$venturePrice)*100;
        return (int) $val;


    }

    public static function isUnderContract($listingId)
    {

        $offer = Offer::where('venture_listing_id',$listingId)
        ->where('status','!=','New Offer')
        ->where('status','!=','Declined')
        ->count();

        if($offer>0)
            return false;

        $buyNow = BuyNow::where('venture_listing_id',$listingId)
        ->where('status','!=','Pending Buyer Docs')
        ->count();

        if($buyNow>0)
            return false;


        return true;

    }

    /* =========================================================================================
          Description: Method For Venture Search
          ----------------------------------------------------------------------------------------
          ========================================================================================== */

          public static function ventureListSearch($filter,$type){


            $ventureType    = $filter['propertyType'];
            $capFrom        = !is_null($filter['capRateFrom'])?(float)$filter['capRateFrom']:null;
            $capTo          = !is_null($filter['capRateTo'])?(float)$filter['capRateTo']:null;

            if($type == VentureListing::TYPE_NEW)
            {
                $purchasePriceFrom  = !is_null($filter['priceRangeFrom'])?(int)$filter['priceRangeFrom']:null;
                $purchasePriceTo    = !is_null($filter['priceRangeTo'])?(int)$filter['priceRangeTo']:null;
            }
            else
            {
                $askingPriceFrom  = !is_null($filter['priceRangeFrom'])?(int)$filter['priceRangeFrom']:null;
                $askingPriceTo    = !is_null($filter['priceRangeTo'])?(int)$filter['priceRangeTo']:null;
            }

            $ventures = Venture::where('deleted_at',null);

            if($ventureType != self::OPTION_ANY)
                $ventures = $ventures->where('venture_type', 'like', '%' . $ventureType . '%');



            if($type == VentureListing::TYPE_NEW)
            {
                if(!is_null($purchasePriceFrom))
                    $ventures = $ventures->where('target_amount','>=',$purchasePriceFrom);

                if(!is_null($purchasePriceTo))
                    $ventures = $ventures->where('target_amount','<=',$purchasePriceTo);
            }

            if($type == VentureListing::TYPE_NEW)
            {
                if(!is_null($capFrom))
                    $ventures = $ventures->where('initial_cap','>=',$capFrom);

                if(!is_null($capTo))
                    $ventures = $ventures->where('initial_cap','<=',$capTo);
            }

            $ventures = $ventures->pluck('id');


            $ventureListing = VentureListing::whereIn('venture_id',$ventures)
            ->where('type', $type);


            $ventureListing = $ventureListing->where('list_status','Live');

            if($type == VentureListing::TYPE_CURRENT)
            {

                if(!is_null($askingPriceFrom))
                    $ventureListing = $ventureListing->where('asking_price','>=',$askingPriceFrom);

                if(!is_null($askingPriceTo))
                    $ventureListing = $ventureListing->where('asking_price','<=',$askingPriceTo);
            }

            $ventureListing = $ventureListing->with('venture')->get();

            $tempVentureListing = [];
            if($type == VentureListing::TYPE_CURRENT)
            {
                foreach($ventureListing as $data)
                {
                    $cap_rate = towDecimalNumber((Helper::calculateRecent12MonthReveneu($data->venture_id)*Helper::percentageOwnershipForSell($data->ownership_id,$data->percentage_of_ownership))/$data->asking_price);
                    if(!is_null($capFrom) && !is_null($capTo))
                    {
                        if($cap_rate >= $capFrom && $cap_rate <= $capTo)
                            $tempVentureListing[] = $data;
                    }
                    elseif(!is_null($capFrom) && $cap_rate >= $capFrom){
                        $tempVentureListing[] = $data;
                    }
                    elseif(!is_null($capTo) && $cap_rate <= $capTo){
                        $tempVentureListing[] = $data;
                    }
                }
                return collect($tempVentureListing);
            }

            return $ventureListing;
        }
    /* =========================================================================================
          Description: Method For Venture List Search for admin side
          ----------------------------------------------------------------------------------------
          ========================================================================================== */

          public static function ventureListAdminSearch($filter,$type)
          {
            $date_listed_from = $filter['date_listed_from'];
            $date_listed_to   = $filter['date_listed_to'];
            $ventureType      = $filter['venture_type'];
            $status           = $filter['listing_status'];
            $ventureId        = $filter['venture_id'];
            $listId           = $filter['listing_id'];
            $ventureName      = $filter['venture_name'];
            $capFrom          = !is_null($filter['cap_from'])?(float)$filter['cap_from']:null;
            $capTo            = !is_null($filter['cap_to'])?(float)$filter['cap_to']:null;

            if($type==VentureListing::TYPE_NEW)
            {
              $amountFrom =  !is_null($filter['target_amount_from'])?(int)$filter['target_amount_from']:null;
              $amountTo   =  !is_null($filter['target_amount_to'])?(int)$filter['target_amount_to']:null;
          }
          else
          {
              $askingPriceFrom = !is_null($filter['asking_price_from'])?(int)$filter['asking_price_from']:null;
              $askingPriceTo   = !is_null($filter['asking_price_to'])?(int)$filter['asking_price_to']:null;
          }
        // TODO: Old Logic. Keeping this for future use
        // $newVentureListing = VentureListing::whereHas('venture', function ($query) use (
        //     $date_listed_from,$date_listed_to, $ventureType, $status, $ventureId, $ventureName, $amountFrom, $amountTo, $listId,$askingPriceFrom,$askingPriceTo
        // ) {
        //     $query
        //         ->orWhere('venture_name', 'like', '%' . $ventureName . '%')
        //         ->orWhere('venture_automated_id', $ventureId)
        //         ->orWhere('list_automated_id', $listId)
        //         ->orwhereBetween('date_of_incorporation', [$date_listed_from, $date_listed_to])
        //         ->orwhereBetween('target_amount', [$amountFrom, $amountTo])
        //         ->orwhereBetween('asking_price', [$askingPriceFrom, $askingPriceTo])
        //         ->orWhere('venture_type', $ventureType);
        // })
        //     ->where('list_status', $status)
        //     ->where('type', $type)
        //     ->get();

          $ventures = Venture::where('deleted_at',null);

          if($ventureType != self::OPTION_ANY)
            $ventures = $ventures->where('venture_type', 'like', '%' . $ventureType . '%');


        if($type == VentureListing::TYPE_NEW)
        {
          if(!is_null($amountFrom))
              $ventures = $ventures->where('target_amount','>=',$amountFrom);

          if(!is_null($amountTo))
            $ventures = $ventures->where('target_amount','<=',$amountTo);
    }

    if(!is_null($ventureName))
        $ventures = $ventures->where('venture_name', 'like', '%' . $ventureName . '%');

    if(!is_null($ventureId))
        $ventures = $ventures->where('venture_automated_id', 'like', '%' . $ventureId . '%');

    if(!is_null($capFrom))
        $ventures = $ventures->where('initial_cap','>=',$capFrom);

    if(!is_null($capTo))
        $ventures = $ventures->where('initial_cap','<=',$capTo);

    $ventures = $ventures->pluck('id');

    $newVentureListing = VentureListing::whereIn('venture_id',$ventures)
    ->where('type', $type);

    if($status != self::OPTION_ANY)
        $newVentureListing = $newVentureListing->where('list_status', 'like', '%' . $status . '%');

    if(!is_null($listId))
        $newVentureListing = $newVentureListing->where('list_automated_id', 'like', '%' . $listId . '%');


    if(!is_null($date_listed_from))
    {
        $date = Carbon::createFromFormat('m-d-Y', $date_listed_from)->format('Y-m-d');
        $newVentureListing = $newVentureListing->whereDate('created_at','>=',$date);
    }

    if(!is_null($date_listed_to))
    {
        $date = Carbon::createFromFormat('m-d-Y', $date_listed_to)->format('Y-m-d');
        $newVentureListing = $newVentureListing->whereDate('created_at','<=',$date);
    }

    if($type == VentureListing::TYPE_CURRENT)
    {
      if(!is_null($askingPriceFrom))
          $newVentureListing = $newVentureListing->where('asking_price','>=',$askingPriceFrom);

      if(!is_null($askingPriceTo))
          $newVentureListing = $newVentureListing->where('asking_price','<=',$askingPriceTo);
  }

  $newVentureListing = $newVentureListing->get();
  return $newVentureListing;
}
    /* =========================================================================================
             Description: Method For Venture  Search for admin side
             ========================================================================================== */
             public static function ventureSearch($filter)
             {
                $ventureName = $filter['ventureName'];
                $ventureId = $filter['venture_id'];


        // return $ventureId;
                $ventures = Venture::where('deleted_at',null);
                if(!is_null($ventureName))
                    $ventures = $ventures->where('venture_name', 'like', '%' . $ventureName . '%');
                if(!is_null($ventureId))
                    $ventures = $ventures->where('venture_automated_id', 'like', '%' . $ventureId . '%');

                $ventures = $ventures->latest()->paginate(5);
                return $ventures;

            }

            public static function ventureSearchAdmin($filter)
            {
                $ventureName        = $filter['venture_name'];
                $ventureId          = $filter['venture_id'];
                $dateCreatedFrom    = $filter['date_created_from'];
                $dateCreatedTo      = $filter['date_created_to'];
                $ventureType        = $filter['type'];

                $ventures = Venture::where('deleted_at',null);

                if($ventureType != self::OPTION_ANY)
                    $ventures = $ventures->where('venture_type', 'like', '%' . $ventureType . '%');

                if(!is_null($ventureName))
                    $ventures = $ventures->where('venture_name', 'like', '%' . $ventureName . '%');
                if(!is_null($ventureId))
                    $ventures = $ventures->where('venture_automated_id', 'like', '%' . $ventureId . '%');


                if(!is_null($dateCreatedFrom))
                {
                    $date = Carbon::createFromFormat('m-d-Y', $dateCreatedFrom)->format('Y-m-d');
                    $ventures = $ventures->whereDate('created_at','>=',$date);
                }

                if(!is_null($dateCreatedTo))
                {
                    $date = Carbon::createFromFormat('m-d-Y', $dateCreatedTo)->format('Y-m-d');
                    $ventures = $ventures->whereDate('created_at','<=',$date);
                }

                $ventures = $ventures->latest()->paginate(5);
                return $ventures;

            }

    /* =========================================================================================
        Description: Method For Make Ownership Units
        ========================================================================================== */
        public static function makeUnits($newVentureListingId,$percentage)
        {
            $units = round(self::TOATAL_UNITS * $percentage);
            $ventureCommit  =  self::getLastCommit($newVentureListingId);

            if(is_null($ventureCommit))
            {
                return [
                    "start" => self::formatSequence(null,1),
                    "end"   => self::formatSequence(null,$units),
                ];
            }
            else
            {
                return [
                    "start" => self::formatSequence($ventureCommit->unitEnd,1),
                    "end"   => self::formatSequence($ventureCommit->unitEnd,$units),
                ];
            }
        }

    /* =========================================================================================
        Description: Get The last commit for a New Venture Listing
        ========================================================================================== */
        public static function getLastCommit($newVentureListingId)
        {
            $ventureCommit  =   VentureCommit::where('new_venture_listing_id',$newVentureListingId)
            ->latest()
            ->first();
            if(empty($ventureCommit))
                return null;
            else
                return $ventureCommit;
        }

    /* =========================================================================================
        Description: Method For Generating a Leading 0's Sequece
        ========================================================================================== */
        public static function formatSequence($number,$increment)
        {
            if ($number == NULL) {
                $defaultInput = 0;
                $number = str_pad($defaultInput, self::OWNERSHIP_SEQUENCE_STRING_LENGTH, self::PAD_STRING_ZERO, STR_PAD_LEFT);
            }

            $number = substr($number, (-1)*(self::OWNERSHIP_SEQUENCE_STRING_LENGTH));
            $number = (int) $number + $increment;

            if($number>self::TOATAL_UNITS)
                $number = self::TOATAL_UNITS;

            return str_pad($number, self::OWNERSHIP_SEQUENCE_STRING_LENGTH, self::PAD_STRING_ZERO, STR_PAD_LEFT);
        }

        public static function leftZeroPadding($number)
        {
            return str_pad($number, self::OWNERSHIP_SEQUENCE_STRING_LENGTH, self::PAD_STRING_ZERO, STR_PAD_LEFT);
        }

    /* =========================================================================================
        Description: Method For Generating a default error object
        ========================================================================================== */
        public static function errorObject($recordNo,$attribute,$message,$value="N/A")
        {
            return [
                "recordNo"=>$recordNo,
                "attribute"=>$attribute,
                "value"=>$value,
                "message"=>$message,
            ];
        }

    /* =========================================================================================
        Description: Method For returning 0 for a number if value is NULL
        ========================================================================================== */
        public static function ifNullReturnZero($value)
        {
            return is_null($value)?0:$value;
        }

    /* =========================================================================================
        Description: Method For Calculating Percantage Owned
        ========================================================================================== */
        public static function percentageOwned($ownership_id)
        {
            $ventureOwnership = VentureOwnership::where('id',$ownership_id)
            ->first();

            $startSequence = intval($ventureOwnership->ownership_sequence_start);
            $endSequence = intval($ventureOwnership->ownership_sequence_end);

            $diff  = ($endSequence-$startSequence)+1;

            $result = ($diff/10000)*100;

        // TODO: Old Logic For Future Use
        // $target_amount = $ventureOwnership->venture->target_amount==0?1:$ventureOwnership->venture->target_amount;
        // $result = ($ventureOwnership->amount_paid/$ventureOwnership->venture->target_amount)*100;

            return round($result,2);
        }

        public static function ownershipAmountPaid($ownership_id)
        {
            $ventureOwnership = VentureOwnership::where('id',$ownership_id)
            ->first();

            if(!empty($ventureOwnership))
            {
                return $ventureOwnership->amount_paid;
            }

            return 0;
        }

        public static function percentageOwnershipForSell($ownership_id,$total_ownership_sell)
        {
            $ventureOwnership = VentureOwnership::where('id',$ownership_id)
            ->first();

            if(!empty($ventureOwnership))
            {
                $startSequence = intval($ventureOwnership->ownership_sequence_start);
                $endSequence = intval($ventureOwnership->ownership_sequence_end);

                $diff  = ($endSequence-$startSequence)+1;

                $ownership_percent = ($diff/10000)*100;


                $result = $ownership_percent*($total_ownership_sell/100);
            // TODO: Old Logic For Future Use
            // $target_amount = $ventureOwnership->venture->target_amount==0?1:$ventureOwnership->venture->target_amount;
            // $result = ($ventureOwnership->amount_paid/$ventureOwnership->venture->target_amount)*100;

                return round($result,2);
            }
            return 0;
        }

        public static function percentageOwnedByObj($ventureOwnership)
        {
            $startSequence = intval($ventureOwnership->ownership_sequence_start);
            $endSequence = intval($ventureOwnership->ownership_sequence_end);
            $diff  = ($endSequence-$startSequence)+1;
            $result = ($diff/10000)*100;
            return round($result,2);
        }

    /* =========================================================================================
        Description: Method For Calculating Estimated Cap
        ========================================================================================== */
        public static function calculateCurrentEstimatedCap($venture_id,$ownership_id)
        {
            $percentageOwned = self::percentageOwned($ownership_id);
        // Get Trailing 12 Months Sum
            $ventureRentalsSum = self::calculateRecent12MonthReveneu($venture_id)*($percentageOwned/100);
            $venturePurchasePrice = self::ownershipAmountPaid($ownership_id);

            $venturePurchasePrice = $venturePurchasePrice==0?1:$venturePurchasePrice;
            return round(($ventureRentalsSum/$venturePurchasePrice)*100,2);
        }

    /* =========================================================================================
        Description: Method For Calculating Original Cap
        ========================================================================================== */
        public static function calculateOrignalCap($ownership_id)
        {
            $ventureOwnership = VentureOwnership::where('id',$ownership_id)
            ->first();
            $date = $ventureOwnership->ownership_begin_date;
            $venture_id = $ventureOwnership->venture_id;

            $percentageOwned = self::percentageOwned($ownership_id);
        // Get Trailing 12 Months Sum
            $ventureRentalsSum = self::calculate12MonthReveneu($venture_id,$date)*($percentageOwned/100);
            $venturePurchasePrice = self::ownershipAmountPaid($ownership_id);


            $venturePurchasePrice = $venturePurchasePrice==0?1:$venturePurchasePrice;
            return round(($ventureRentalsSum/$venturePurchasePrice)*100,2);
        }

    /* =========================================================================================
        Description: Method For Calculating Recent 12 Months Reveneu
        ========================================================================================== */
        public static function calculateRecent12MonthReveneu($venture_id)
        {
            $result = VentureRental::where('venture_id',$venture_id)
            ->orderBy('date_rent_collected','desc')
            ->limit(12)
            ->get();

            // dd($result->sum('net_income'));
            return $result->sum('net_income');
        }

    /* =========================================================================================
        Description: Method For Calculating 12 Months Reveneu From Selected Month
        ========================================================================================== */
        public static function calculate12MonthReveneu($venture_id,$date)
        {
            $date = Carbon::parse($date)->format('m/d/y');

            $result = VentureRental::where('venture_id',$venture_id)
            ->whereMonth('date_rent_collected','<=',$date)
            ->orderBy('date_rent_collected','desc')
            ->limit(12)
            ->get();
            return $result->sum('net_income');
        }

    /* =========================================================================================
        Description: Method For Getting Purchase Price of a venture
        ========================================================================================== */
        public static function getVenturePurchasePrice($venture_id)
        {
            $venture = Venture::where('id',$venture_id)->first();

            if(!empty($venture))
                return $venture->purchase_price;

            return 0;
        }

    /* =========================================================================================
        Description: Method For Calculating Current Aproximation Valuation
        ========================================================================================== */
        public static function calculateCurrentApproximateValuation($ownership_id,$venture_id)
        {
            $percentageOwned = self::percentageOwned($ownership_id);

            // Get Trailing 12 Months Sum
            $recent12MonthReveneu = self::calculateRecent12MonthReveneu($venture_id)*($percentageOwned);

            $venture = Venture::where('id',$venture_id)->first();
            $orignalCap = $venture->initial_cap;

            $currentApproximateValuation = ($recent12MonthReveneu/$orignalCap);

            return round($currentApproximateValuation,2);
        }

    /* =========================================================================================
        Description: Method For Calculating Current Aproximation Valuation
        ========================================================================================== */
        public static function calculateApproximateValuation($ownership_id,$venture_id,$date)
        {
            $percentageOwned = self::percentageOwned($ownership_id);
        // Get Trailing 12 Months Sum
            $recent12MonthReveneu = self::calculate12MonthReveneu($venture_id,$date)*($percentageOwned/100);
            $orignalCap = self::calculateOrignalCap($ownership_id);

            $orignalCap = $orignalCap==0?1:$orignalCap;

            $currentApproximateValuation = ($recent12MonthReveneu/$orignalCap)*$percentageOwned;

            return round($currentApproximateValuation,2);
        }

        public static function compareStatuses($oldStatus, $newStatus)
        {
            if(($oldStatus == "Pending" || $oldStatus == "" || $oldStatus == null ) && $newStatus == 'Negotiating')
                return true;
            else if($oldStatus == 'Negotiating' && $newStatus == 'Deal Dead')
                return true;
            else if($oldStatus == 'Negotiating' && $newStatus == 'Closing')
                return true;
            else if($oldStatus == 'Closing' && $newStatus == 'Closed')
                return true;
            else
                return false;
        }

    // TODO: Old Logic for future reference
    // public static function checkIfSellingExist($ventureId,$userId)
    // {
    //     $ventureListIds = UserVentureListing::where('venture_id',$ventureId)
    //                                     ->where('user_id',$userId)
    //                                     ->pluck('venture_listing_id');

    //     $ventureList = VentureListing::whereIn('id',$ventureListIds)
    //                                 ->where('status','Pending')
    //                                 ->first();

    //     if(empty($ventureList))
    //         return true;
    //     else
    //         return false;
    // }

        public static function checkIfSellingExist($ownership_id)
        {

            $ventureList = VentureListing::where('ownership_id',$ownership_id)
            ->where('status','Pending')
            ->first();

            if(empty($ventureList))
                return true;
            else
                return false;
        }

        public static function getOfferedCapRate($ventureListingId)
        {
            $ventureListing = VentureListing::where('id',$ventureListingId)
            ->first();
            $userVentureListing = UserVentureListing::where('venture_listing_id',$ventureListingId)
            ->first();
            $ventureOwnership = VentureOwnership::where('venture_id',$ventureListing->venture_id)
            ->where('user_id',$userVentureListing->user_id)
            ->where('isDeleted',0)
            ->first();
            $percentageOwned  = self::percentageOwned($ventureOwnership->id);
            $ventureRentalsSum = self::calculateRecent12MonthReveneu($ventureListing->venture_id)*($percentageOwned/100);

            $percentageToSell = ($ventureListing->percentage_of_ownership*$percentageOwned)/100;

            $amountToMultiply = 100/$percentageToSell;

            $asking_price = is_null($ventureListing->asking_price)?1:$ventureListing->asking_price;
            $ventureTotalValue = $amountToMultiply*$asking_price;

            return round(($ventureRentalsSum/$ventureTotalValue)*100,2);

            return $ventureTotalValue;
        }

        public static function makeCommunicationObj($fromUser,$toUsers,$ventureId,$subject,$body)
        {
            $communicationObj = [];
            for($i=0;$i<count($toUsers);$i++)
            {
                if($toUsers[$i]!=$fromUser)
                {
                    $communicationObj[] = [
                        "from_user"     => $fromUser,
                        "to_user"       => $toUsers[$i],
                        "venture_id"    => $ventureId,
                        "subject"       => $subject,
                        "body"          => $body,
                        "read_status"   => 0
                    ];
                }
            }

            return $communicationObj;
        }

        public static function sendCommunicationEmail($request,$user,$venture,$emails)
        {
            \Mail::send('email.communicationEmail',["request"=>$request,"user"=>$user,"venture"=>$venture], function ($message) use ($emails) {
                $message->from('contact@gmail.com', 'Member Communication');
                $message->to($emails)->subject('Member Communication');
            });
        }
        public static function dynamicColors() {
            $colors = [
                "#63b598", "#ce7d78", "#ea9e70", "#a48a9e", "#c6e1e8", "#648177" ,"#0d5ac1" ,
                "#f205e6" ,"#1c0365" ,"#14a9ad" ,"#4ca2f9" ,"#a4e43f" ,"#d298e2" ,"#6119d0",
                "#d2737d" ,"#c0a43c" ,"#f2510e" ,"#651be6" ,"#79806e" ,"#61da5e" ,"#cd2f00" ,
                "#9348af" ,"#01ac53" ,"#c5a4fb" ,"#996635","#b11573" ,"#4bb473" ,"#75d89e" ,
                "#2f3f94" ,"#2f7b99" ,"#da967d" ,"#34891f" ,"#b0d87b" ,"#ca4751" ,"#7e50a8" ,
                "#c4d647" ,"#e0eeb8" ,"#11dec1" ,"#289812" ,"#566ca0" ,"#ffdbe1" ,"#2f1179" ,
                "#935b6d" ,"#916988" ,"#513d98" ,"#aead3a", "#9e6d71", "#4b5bdc", "#0cd36d",
                "#250662", "#cb5bea", "#228916", "#ac3e1b", "#df514a", "#539397", "#880977",
                "#f697c1", "#ba96ce", "#679c9d", "#c6c42c", "#5d2c52", "#48b41b", "#e1cf3b",
                "#5be4f0", "#57c4d8", "#a4d17a", "#225b8", "#be608b", "#96b00c", "#088baf",
                "#f158bf", "#e145ba", "#ee91e3", "#05d371", "#5426e0", "#4834d0", "#802234",
                "#6749e8", "#0971f0", "#8fb413", "#b2b4f0", "#c3c89d", "#c9a941", "#41d158",
                "#fb21a3", "#51aed9", "#5bb32d", "#807fb", "#21538e", "#89d534", "#d36647",
                "#7fb411", "#0023b8", "#3b8c2a", "#986b53", "#f50422", "#983f7a", "#ea24a3",
                "#79352c", "#521250", "#c79ed2", "#d6dd92", "#e33e52", "#b2be57", "#fa06ec",
                "#1bb699", "#6b2e5f", "#64820f", "#1c271", "#21538e", "#89d534", "#d36647",
                "#7fb411", "#0023b8", "#3b8c2a", "#986b53", "#f50422", "#983f7a", "#ea24a3",
                "#79352c", "#521250", "#c79ed2", "#d6dd92", "#e33e52", "#b2be57", "#fa06ec",
                "#1bb699", "#6b2e5f", "#64820f", "#1c271", "#9cb64a", "#996c48", "#9ab9b7",
                "#06e052", "#e3a481", "#0eb621", "#fc458e", "#b2db15", "#aa226d", "#792ed8",
                "#73872a", "#520d3a", "#cefcb8", "#a5b3d9", "#7d1d85", "#c4fd57", "#f1ae16",
                "#8fe22a", "#ef6e3c", "#243eeb", "#1dc18", "#dd93fd", "#3f8473", "#e7dbce",
                "#421f79", "#7a3d93", "#635f6d", "#93f2d7", "#9b5c2a", "#15b9ee", "#0f5997",
                "#409188", "#911e20", "#1350ce", "#10e5b1", "#fff4d7", "#cb2582", "#ce00be",
                "#32d5d6", "#17232", "#608572", "#c79bc2", "#00f87c", "#77772a", "#6995ba",
                "#fc6b57", "#f07815", "#8fd883", "#060e27", "#96e591", "#21d52e", "#d00043",
                "#b47162", "#1ec227", "#4f0f6f", "#1d1d58", "#947002", "#bde052", "#e08c56",
                "#28fcfd", "#bb09b", "#36486a", "#d02e29", "#1ae6db", "#3e464c", "#a84a8f",
                "#911e7e", "#3f16d9", "#0f525f", "#ac7c0a", "#b4c086", "#c9d730", "#30cc49",
                "#3d6751", "#fb4c03", "#640fc1", "#62c03e", "#d3493a", "#88aa0b", "#406df9",
                "#615af0", "#4be47", "#2a3434", "#4a543f", "#79bca0", "#a8b8d4", "#00efd4",
                "#7ad236", "#7260d8", "#1deaa7", "#06f43a", "#823c59", "#e3d94c", "#dc1c06",
                "#f53b2a", "#b46238", "#2dfff6", "#a82b89", "#1a8011", "#436a9f", "#1a806a",
                "#4cf09d", "#c188a2", "#67eb4b", "#b308d3", "#fc7e41", "#af3101", "#ff065",
                "#71b1f4", "#a2f8a5", "#e23dd0", "#d3486d", "#00f7f9", "#474893", "#3cec35",
                "#1c65cb", "#5d1d0c", "#2d7d2a", "#ff3420", "#5cdd87", "#a259a4", "#e4ac44",
                "#1bede6", "#8798a4", "#d7790f", "#b2c24f", "#de73c2", "#d70a9c", "#25b67",
                "#88e9b8", "#c2b0e2", "#86e98f", "#ae90e2", "#1a806b", "#436a9e", "#0ec0ff",
                "#f812b3", "#b17fc9", "#8d6c2f", "#d3277a", "#2ca1ae", "#9685eb", "#8a96c6",
                "#dba2e6", "#76fc1b", "#608fa4", "#20f6ba", "#07d7f6", "#dce77a", "#77ecca"];

                $index = rand(0,count($colors)-1);

                return $colors[$index];
            }

            public static function getPercentageArr($valueArr,$total)
            {
                $resArr = [];
                for($i=0;$i<count($valueArr);$i++)
                {
                    $resArr[] = number_format(($valueArr[$i]/$total)*100, 2, '.', '');
                }

                return $resArr;
            }

            public static function unreadMessageCounter()
            {
                if(auth()->user())
                    return Communication::where('to_user',auth()->user()->id)->where('read_status',0)->has('venture')->count();
                return;
            }

            public static function unfilledSurveyCounter()
            {
                if(auth()->user())
                {
                    $surveyIds = UserFilledSurvey::where('user_id',auth()->user()->id)->pluck('survey_id');
                    $now = Carbon::now()->format('Y-m-d H:i');
                    $ventureIds = VentureOwnership::where('user_id',auth()->user()->id)->where('isDeleted',0)->pluck('venture_id');
                    return Survey::whereIn('venture_id',$ventureIds)
                    ->whereNotIn('id',$surveyIds)
                    ->where('due_date','>=',$now)
                    ->count();
                }
                return;
            }

            public static function propertyManagersNotIncluded($existedIds)
            {
                $role       = Role::where('name', 'Property Manager')->first();
                $userIds    = UserRole::where('role_id',$role->id)->pluck('user_id');

                return User::whereIn('id',$userIds)->whereNotIn('id',$existedIds)->get();
            }

    /* =========================================================================================
             Description: Method For Venture  Search for admin side
             ========================================================================================== */
             public static function communicationSearch($filter)
             {
                $ventureName        = $filter['venture_name'];
                $ventureId          = $filter['venture_id'];
                $dateCreatedFrom    = $filter['date_created_from'];
                $dateCreatedTo      = $filter['date_created_to'];
                $toUser             = $filter['to_user'];
                $ventureCondition   = false;

                $ventures = Venture::where('deleted_at',null);
                if(!is_null($ventureName))
                {
                    $ventures = $ventures->where('venture_name', 'like', '%' . $ventureName . '%');
                    $ventureCondition = true;
                }
                if(!is_null($ventureId))
                {
                    $ventures = $ventures->where('venture_automated_id', 'like', '%' . $ventureId . '%');
                    $ventureCondition = true;
                }

                $ventures = $ventures->pluck('id');


                $communications = Communication::where('to_user',$toUser);
                if(!is_null($dateCreatedFrom))
                {
                    $date = Carbon::createFromFormat('m/d/Y', $dateCreatedFrom)->format('Y-m-d');
                    $communications = $communications->whereDate('created_at','>=',$date);
                }

                if(!is_null($dateCreatedTo))
                {
                    $date = Carbon::createFromFormat('m/d/Y', $dateCreatedTo)->format('Y-m-d');
                    $communications = $communications->whereDate('created_at','<=',$date);
                }

                if($ventureCondition)
                {
                    $communications = $communications->whereIn('venture_id',$ventures);
                }

                $communications = $communications->has('venture')->latest()->paginate(5);
                return $communications;
            }

    /* =========================================================================================
             Description: Method For Venture  Search for admin side
             ========================================================================================== */
             public static function surveySearch($filter)
             {
                $ventureName        = $filter['venture_name'];
                $ventureId          = $filter['venture_id'];
                $dateCreatedFrom    = $filter['date_created_from'];
                $dateCreatedTo      = $filter['date_created_to'];
                $userId             = $filter['to_user'];
                $ventureCondition   = false;

                $ventures = Venture::where('deleted_at',null);
                if(!is_null($ventureName))
                {
                    $ventures = $ventures->where('venture_name', 'like', '%' . $ventureName . '%');
                    $ventureCondition = true;
                }
                if(!is_null($ventureId))
                {
                    $ventures = $ventures->where('venture_automated_id', 'like', '%' . $ventureId . '%');
                    $ventureCondition = true;
                }

                $ventures = $ventures->pluck('id');


                $surveys = Survey::where('user_id',$userId);
                if(!is_null($dateCreatedFrom))
                {
                    $date = Carbon::createFromFormat('m/d/Y', $dateCreatedFrom)->format('Y-m-d');
                    $surveys = $surveys->whereDate('due_date','>=',$date);
                }

                if(!is_null($dateCreatedTo))
                {
                    $date = Carbon::createFromFormat('m/d/Y', $dateCreatedTo)->format('Y-m-d');
                    $surveys = $surveys->whereDate('due_date','<=',$date);
                }

                if($ventureCondition)
                {
                    $surveys = $surveys->whereIn('venture_id',$ventures);
                }

                $surveys = $surveys->has('venture')->latest()->paginate(5);
                return $surveys;
            }

            public static function surveySearchUser($filter)
            {
                $ventureName        = $filter['venture_name'];
                $ventureId          = $filter['venture_id'];
                $dateCreatedFrom    = $filter['date_created_from'];
                $dateCreatedTo      = $filter['date_created_to'];
                $userId             = $filter['to_user'];
                $ventureCondition   = false;

                $ventureIds = VentureOwnership::where('user_id',$userId)->where('isDeleted',0)->pluck('venture_id');

                $ventures = Venture::whereIn('id',$ventureIds);
                if(!is_null($ventureName))
                {
                    $ventures = $ventures->where('venture_name', 'like', '%' . $ventureName . '%');
                }
                if(!is_null($ventureId))
                {
                    $ventures = $ventures->where('venture_automated_id', 'like', '%' . $ventureId . '%');
                }

                $ventures = $ventures->pluck('id');

                $surveyIds = UserFilledSurvey::where('user_id',$userId)->pluck('survey_id');

                $now = Carbon::now()->format('Y-m-d');

                $surveys = Survey::whereIn('venture_id',$ventures)->whereNotIn('id',$surveyIds)->whereDate('due_date','>=',$now);
                if(!is_null($dateCreatedFrom))
                {
                    $date = Carbon::createFromFormat('m/d/Y', $dateCreatedFrom)->format('Y-m-d');
                    $surveys = $surveys->whereDate('due_date','>=',$date);
                }

                if(!is_null($dateCreatedTo))
                {
                    $date = Carbon::createFromFormat('m/d/Y', $dateCreatedTo)->format('Y-m-d');
                    $surveys = $surveys->whereDate('due_date','<=',$date);
                }

                $surveys = $surveys->has('venture')->latest()->paginate(5);
                return $surveys;
            }

            public static function carbonParseFormat($value)
            {
                return Carbon::parse($value)->format('m/d/Y');
            }

            public static function optionPercentage($optionId,$surveyId)
            {
                $pickedOptionUserIds = PickedOption::where('option_id',$optionId)->pluck('user_id')->toArray();

                $userIds = UserFilledSurvey::where('survey_id',$surveyId)->pluck('user_id');


                $survey = Survey::where('id',$surveyId)->first();

                $ventureOwnerships = VentureOwnership::whereIn('user_id',$userIds)
                ->where('venture_id',$survey->venture_id)
                ->where('isDeleted',0)
                ->get();

                $totalPercentage = 0;
                $optionPercentage = 0;
                foreach ($ventureOwnerships as $key => $ventureOwnership)
                {
                    $totalPercentage = $totalPercentage + Helper::percentageOwned($ventureOwnership->id);

                    if(in_array($ventureOwnership->user_id, $pickedOptionUserIds))
                    {
                        $optionPercentage = $optionPercentage + Helper::percentageOwned($ventureOwnership->id);
                    }
                }

                $adjustment = 1;
                if($totalPercentage<100 && $totalPercentage>0)
                    $adjustment = 100/$totalPercentage;


                return number_format(($optionPercentage*$adjustment), 2, '.', '');
            }

            public static function nextBillingDate($customerId)
            {
                $secretKey = Config::get('constants.STRIPE_SECRET');
                $stripe = new \Stripe\StripeClient($secretKey);
                $data = $stripe->invoices->upcoming([
                  'customer' => $customerId,
              ]);
        // TODO: For Future Use
        // $cu = $stripe->customers->update($customerId, [
        //             'name' => 'Test'
        //         ]);
                return \Carbon\Carbon::parse($data->date)->format('m/d/Y');
            }

            public static function checkOfferExist($ventureListingId,$userId)
            {
                $offer = Offer::where('user_id',$userId)
                ->where('venture_listing_id',$ventureListingId)
                ->where('status','New Offer')
                ->first();
                if(!empty($offer))
                    return false;
                return true;
            }

            public static function listingUser($listingId)
            {
                $userVentureListing  = UserVentureListing::where('venture_listing_id',$listingId)
                ->first();

                $user = User::find($userVentureListing->user_id);
                if(!empty($user))
                    return $user->name;
                else
                    return 'N/A';
            }

            public static function getState($id)
            {
                $state = State::find($id);

                if(!empty($state))
                    return $state->name;
                return "N/A";
            }

            public static function buyNowFundingCount()
            {
                return BuyNow::where('status','Funding')->count();
            }

            public static function offerFundingCount()
            {
                return Offer::where('status','Funding')->count();
            }

            public static function commitFundingCount()
            {
                return VentureCommit::where('status','Funding')->count();
            }

            public static function allFundingCount()
            {
                return self::buyNowFundingCount()+self::offerFundingCount()+self::commitFundingCount();
            }

            public static function membersCount()
            {
                $userIds = UserRole::where('role_id',2)->pluck('user_id');
                return User::whereIn('id',$userIds)->count();
            }

            public static function newVentureRemainingCommitAmount($ventureListingId)
            {
                $ventureList = VentureListing::where('id', $ventureListingId)->first();
                $newVentureCommit = VentureCommit::where('new_venture_listing_id', '=', $ventureListingId)->sum('amount');
                return $ventureList->venture->target_amount - $newVentureCommit;
            }
        }



