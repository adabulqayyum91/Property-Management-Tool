<?php

use Carbon\Carbon;

use App\State;


function isProfileComplete(){
	$user = \Auth::user();

	if($user->name != null && $user->first_name != null && $user->last_name != null && $user->phone != null && $user->street != null && $user->city != null && $user->state != null && $user->zip != null && $user->date_of_birth != null && $user->social_security_number != null)
	{
		return true;
	}

	return false;
}

function formatCurrency($amount)
{
	return Config::get('constants.CURRENCY_SIGN').number_format(!is_null($amount) ? $amount : '0', 2, '.', ',');
}

function formatCurrencyWithoutSymbol($amount)
{
	return number_format(!is_null($amount) ? $amount : '0', 2, '.', ',');
}

function percentage($valueA,$valueB)
{
	return number_format( ($valueA/$valueB)*100, 2,'.','');
}


function towDecimalNumber($value)
{
	return number_format( $value, 2,'.','');
}


function formatCurrencyWoSign($amount)
{
	return number_format(!is_null($amount) ? $amount : '0', 2, '.', ',');
}

function formatYMD($value)
{
	return Carbon::parse($value)->format('Y-m-d');
}

function formatMDY($value)
{
	return Carbon::parse($value)->format('m/d/Y');
}

function formatMDYTime($value)
{
	return Carbon::parse($value)->format('m/d/Y h:m A');
}

function valueOrNa($value)
{
	return $value? $value:'N/A';
}


function getVentureImageSource($venture)
{
	$v = $venture->medias()->where('type', 'IMAGE')->pluck('id')->toArray();
	$fileSource = '';
	$fv = $venture->featuredImageId;
	// if(in_array($fv, $v))
	if($venture->featuredImageId)
	{
		$fileSource = $venture->medias()->find($venture->featuredImageId);

		if(empty($fileSource))
			$fileSource = $venture->venture->medias()->find($venture->featuredImageId);

		if(!empty($fileSource))
			$fileSource =  $fileSource->file_name;
		else
			$fileSource = 'img/default-image.png';
		
	}
	else 
	{

		if ($venture->medias()->where('type', 'IMAGE')->first())
		{
			$fileSource = $venture->medias()->where('type', 'IMAGE')->first()->file_name;
		}
		elseif($venture->venture->medias()->where('type', 'IMAGE')->first())
		{
			$fileSource = $venture->venture->medias()->where('type', 'IMAGE')->first()->file_name;
		}
		else
		{
			$fileSource = 'img/default-image.png';
		}
	}   
	if($fileSource!='img/default-image.png')          
		$fileSource = asset('uploads/ventures/'.$fileSource); 

	return $fileSource;
}


function amountPercentage($amount, $percentage=3.5){
	$percentage = $percentage/100;
	return $amount * $percentage;
}

function getState($id)
{
	$state = State::find($id);

	if(!empty($state))
		return $state->name;
	return "N/A";
}