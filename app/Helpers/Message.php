<?php
namespace App\Helpers;

use Closure;
use Illuminate\Http\Request;

class Message
{
	// Flashes
	const FLASH_SUCCESS = "success";


	// Messages
	const IMPORT_SUCCESS = "Data Imported Successfully!";
	const DELETE_SUCCESS = "Data Deleted Successfully!";

	const ALREADY_EXIST = "Already exist.";
	const FIELD_REQUIRED = "Following field is required.";
    const VALUE_INVALID = "Invalid Value";
    const SEQUENCE_CLASHED = "Ownership in clash with other records";

    const OWNERSHIP_UPDATE_SUCCESS = "Ownership Data successfully Updated!";
    const DATA_UPDATED_SUCCESS = "Data Updated Successfully!";
    const SOMETHING_WENT_WRONG = "Something Went Wrong!";
    const SELECT_VENTURE_FIRST = "Select Venture First!";

}