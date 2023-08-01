<?php

if(extension_loaded("mbstring"))
{
	$acceptCharsetHeader = "Accept-Charset: " . mb_internal_encoding();
	header( $acceptCharsetHeader );
	$head = "<html><head><meta http-equiv='Content-Type' content='text/html; charset=" . mb_http_output() . "></head>";
	echo( $head );
}

// Build connection object
//if ($connType == "MYSQL")
if ($HTTP_POST_VARS['Type'] == "MYSQL")
{
	require("mysql.php");
	$oConn = new MySqlConnection($HTTP_POST_VARS['ConnectionString'], $HTTP_POST_VARS['Timeout'], $HTTP_POST_VARS['Host'], $HTTP_POST_VARS['Database'], $HTTP_POST_VARS['UserName'], $HTTP_POST_VARS['Password']);
}

// Process opCode
if ($oConn)
{
	$oConn->Open();

	if ($HTTP_POST_VARS['opCode'] == "IsOpen")
		echo($oConn->TestOpen());
	elseif ($oConn->connectionId && $oConn->isOpen)
	{
		if	   ($HTTP_POST_VARS['opCode'] == "GetTables")				 echo($oConn->GetTables());
		elseif ($HTTP_POST_VARS['opCode'] == "GetColsOfTable")				 echo($oConn->GetColumnsOfTable($HTTP_POST_VARS['TableName']));
		elseif ($HTTP_POST_VARS['opCode'] == "ExecuteSQL")				 echo($oConn->ExecuteSQL($HTTP_POST_VARS['SQL'], $HTTP_POST_VARS['MaxRows']));
		elseif ($HTTP_POST_VARS['opCode'] == "GetODBCDSNs")				 echo($oConn->GetDatabaseList());
		elseif ($HTTP_POST_VARS['opCode'] == "SupportsProcedure")		 echo($oConn->SupportsProcedure());
		elseif ($HTTP_POST_VARS['opCode'] == "GetProviderTypes")		 echo($oConn->GetProviderTypes());
		elseif ($HTTP_POST_VARS['opCode'] == "GetViews")				 echo($oConn->GetViews());
		elseif ($HTTP_POST_VARS['opCode'] == "GetProcedures")			 echo($oConn->GetProcedures());
		elseif ($HTTP_POST_VARS['opCode'] == "GetParametersOfProcedure") echo($oConn->GetParametersOfProcedure($HTTP_POST_VARS['ProcName']));
		elseif ($HTTP_POST_VARS['opCode'] == "ReturnsResultset")		 echo($oConn->ReturnsResultSet($HTTP_POST_VARS['RRProcName']));
		elseif ($HTTP_POST_VARS['opCode'] == "ExecuteSP")				 echo($oConn->ExecuteSP($HTTP_POST_VARS['ExecProcName'], 0, $HTTP_POST_VARS['ExecProcParameters']));
		elseif ($HTTP_POST_VARS['opCode'] == "GetKeysOfTable")   echo($oConn->GetPrimaryKeysOfTable($HTTP_POST_VARS['TableName']));
	}

	// if (!$oConn->isOpen)
	// handle exception is actually called by TestOpen, so this call is not needed
	//	echo($oConn->HandleException());

	$oConn->Close();
}

echo( "</html>" );
?>