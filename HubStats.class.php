<?php

class HubStats extends Codondata {
	
	public static function Pilots($icao) { //Pilot details
		$query = "SELECT * FROM ".TABLE_PREFIX."pilots WHERE hub = '".$icao."'";
		return DB::get_results($query);
	}
	
	public static function CountPilots($icao) { //Number of pilots
		$query = "SELECT COUNT(pilotid) as count FROM ".TABLE_PREFIX."pilots WHERE hub = '".$icao."'";
		$results = DB::get_row($query);
		return $results->count;
	}
	
	public static function CountFlights($icao) { //Number of flights total
		$query = "SELECT COUNT(pirepid) as count FROM ".TABLE_PREFIX."pireps WHERE arricao = '".$icao."' OR depicao = '".$icao."'";
		$results = DB::get_row($query);
		return $results->count;
	}
	
	public static function CountFlightsFrom($icao) { //Number of flights departing
		$query = "SELECT COUNT(pirepid) as count FROM ".TABLE_PREFIX."pireps WHERE depicao = '".$icao."'";
		$results = DB::get_row($query);
		return $results->count;
	}
	
	public static function CountFlightsTo($icao) { //Number of flights arriving
		$query = "SELECT COUNT(pirepid) FROM ".TABLE_PREFIX."pireps WHERE arricao = '".$icao."'";
		$results = DB::get_row($query);
		return $results->count;
	}
	
	public static function FlightsDetails($icao, $limit=10) { //Details of latest (10) flights
		$query = "SELECT * FROM ".TABLE_PREFIX."pireps WHERE depicao = '".$icao."' OR arricao = '".$icao."' ORDER BY submitdate DESC LIMIT ".intval($limit);
		return DB::get_results($query);
	}
	
	public static function CountRoutes($icao) { //Count schedules
		$query = "SELECT COUNT(id) as count FROM ".TABLE_PREFIX."schedules WHERE depicao = '".$icao."' OR arricao = '".$icao."'";
		$results = DB::get_row($query);
		return $results->count;
	}
	
	public static function CountRoutesFrom($icao) { //Count schedules departing
		$query = "SELECT COUNT(id) as count FROM ".TABLE_PREFIX."schedules WHERE depicao = '".$icao."'";
		$results = DB::get_row($query);
		return $results->count;
	}
	
	public static function CountRoutesTo($icao) { //Count schedules arriving
		$query = "SELECT COUNT(id) as count FROM ".TABLE_PREFIX."schedules WHERE arricao = '".$icao."'";
		$results = DB::get_results($query);
		return $results->count;
	}
	
	public static function TotalMiles($icao) { //Count miles flown
		$query = "SELECT SUM(distance) as miles FROM ".TABLE_PREFIX."pireps WHERE depicao = '".$icao."' OR arricao = '".$icao."'";
		$result = DB::get_row($query);
		return $result->miles;
	}
	
	public static function TotalMilesFrom($icao) { //Count miles flown departing
		$query = "SELECT SUM(distance) as miles FROM ".TABLE_PREFIX."pireps WHERE depicao = '".$icao."'";
		$result = DB::get_row($query);
		return $result->miles;
	}
	
	public static function TotalMilesTo($icao) { //Count miles flown arriving
		$query = "SELECT SUM(distance) as miles FROM ".TABLE_PREFIX."pireps WHERE arricao = '".$icao."'";
		$result = DB::get_row($query);
		return $result->miles;
	}
	
	public static function TotalHours($icao) { //Count total hours
		$query = "SELECT SUM(flighttime) as hours FROM ".TABLE_PREFIX."pireps WHERE depicao = '".$icao."' OR arricao = '".$icao."'";
		$result = DB::get_row($query);
		return $result->hours;
	}
	
	public static function TotalHoursFrom($icao) { //Count total hours departing
		$query = "SELECT SUM(flighttime) as hours FROM ".TABLE_PREFIX."pireps WHERE depicao = '".$icao."'";
		$result = DB::get_row($query);
		return $result->hours;
	}
	
	public static function TotalHoursTo($icao) { //Count total hours arriving
		$query = "SELECT SUM(flighttime) as hours FROM ".TABLE_PREFIX."pireps WHERE arricao = '".$icao."'";
		$result = DB::get_row($query);
		return $result->hours;
	}
	
	public function TotalFuelUsed($icao) { //Count total fuel used arriving
		$query = "SELECT SUM(fuelused) as fuel FROM ".TABLE_PREFIX."pireps WHERE arricao = '".$icao."'";
		$result = DB::get_row($query);
		return $result->fuel;
	}

}
?>
