<?php

class HubStats extends Codondata {
	
	public function Pilots($icao) { //Pilot details
		$query = "SELECT * FROM ".TABLE_PREFIX."pilots WHERE hub = '".$icao."'";
		return DB::get_results($query);
	}
	
	public function CountPilots($icao) { //Number of pilots
		$query = "SELECT * FROM ".TABLE_PREFIX."pilots WHERE hub = '".$icao."'";
		$results = DB::get_results($query);
		return DB::num_rows($results);
	}
	
	public function CountFlights($icao) { //Number of flights total
		$query = "SELECT * FROM ".TABLE_PREFIX."pireps WHERE arricao = '".$icao."' OR depicao = '".$icao."'";
		$results = DB::get_results($query);
		return DB::num_rows($results);
	}
	
	public function CountFlightsFrom($icao) { //Number of flights departing
		$query = "SELECT * FROM ".TABLE_PREFIX."pireps WHERE depicao = '".$icao."'";
		$results = DB::get_results($query);
		return DB::num_rows($results);
	}
	
	public function CountFlightsTo($icao) { //Number of flights arriving
		$query = "SELECT * FROM ".TABLE_PREFIX."pireps WHERE arricao = '".$icao."'";
		$results = DB::get_results($query);
		return DB::num_rows($results);
	}
	
	public function FlightsDetails($icao, $limit=10) { //Details of latest (10) flights
		$query = "SELECT * FROM ".TABLE_PREFIX."pireps WHERE depicao = '".$icao."' OR arricao = '".$icao."' ORDER BY submitdate DESC LIMIT ".intval($limit);
		$results = DB::get_results($query);
		return $results;
	}
	
	public function CountRoutes($icao) { //Count schedules
		$query = "SELECT * FROM ".TABLE_PREFIX."schedules WHERE depicao = '".$icao."' OR arricao = '".$icao."'";
		$results = DB::get_results($query);
		return DB::num_rows($results);
	}
	
	public function CountRoutesFrom($icao) { //Count schedules departing
		$query = "SELECT * FROM ".TABLE_PREFIX."schedules WHERE depicao = '".$icao."'";
		$results = DB::get_results($query);
		return DB::num_rows($results);
	}
	
	public function CountRoutesTo($icao) { //Count schedules arriving
		$query = "SELECT * FROM ".TABLE_PREFIX."schedules WHERE arricao = '".$icao."'";
		$results = DB::get_results($query);
		return DB::num_rows($results);
	}
	
	public function TotalMiles($icao) { //Count miles flown
		$query = "SELECT SUM(distance) as miles FROM ".TABLE_PREFIX."pireps WHERE depicao = '".$icao."' OR arricao = '".$icao."'";
		$result = DB::get_row($query);
		return $result->miles;
	}
	
	public function TotalMilesFrom($icao) { //Count miles flown departing
		$query = "SELECT SUM(distance) as miles FROM ".TABLE_PREFIX."pireps WHERE depicao = '".$icao."'";
		$result = DB::get_row($query);
		return $result->miles;
	}
	
	public function TotalMilesTo($icao) { //Count miles flown arriving
		$query = "SELECT SUM(distance) as miles FROM ".TABLE_PREFIX."pireps WHERE arricao = '".$icao."'";
		$result = DB::get_row($query);
		return $result->miles;
	}
	
	public function TotalHours($icao) { //Count total hours
		$query = "SELECT SUM(flighttime) as hours FROM ".TABLE_PREFIX."pireps WHERE depicao = '".$icao."' OR arricao = '".$icao."'";
		$result = DB::get_row($query);
		return $result->hours;
	}
	
	public function TotalHoursFrom($icao) { //Count total hours departing
		$query = "SELECT SUM(flighttime) as hours FROM ".TABLE_PREFIX."pireps WHERE depicao = '".$icao."'";
		$result = DB::get_row($query);
		return $result->hours;
	}
	
	public function TotalHoursTo($icao) { //Count total hours arriving
		$query = "SELECT SUM(flighttime) as hours FROM ".TABLE_PREFIX."pireps WHERE arricao = '".$icao."'";
		$result = DB::get_row($query);
		return $result->hours;
	}

}
?>