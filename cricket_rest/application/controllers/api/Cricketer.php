<?php
require APPPATH . 'libraries/REST_Controller.php';

class Cricketer extends REST_Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function index_get($id = 0) {
        $query = "SELECT p.id, p.name, p.age, t.name team, s.roll, s.matches, s.runs, s.run_rate, s.strike_rate, s.fours, s.sixes,
        s.fifties, s.hundreds, s.wickets, s.wickets_strike_rate, s.economy_rate, s.maidens, s.five_wickets, s.catches FROM 
        ((`player` p INNER JOIN `team` t
        ON p.team_id=t.id)
         INNER JOIN statistics s ON p.stats_id=s.id) WHERE p.deleted=0";
        if(!empty($id)){
            $query .= " AND p.id=$id ORDER BY p.id";
            $data = $this->db->query($query)->row_array();
            // $data = $this->db->get_where('player',array('id'=>$id))->row_array();
        }else{
            $query .= " ORDER BY p.id";
            $data = $this->db->query($query)->result();
            // $data = $this->db->get('player')->result();
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function index_post(){
        // INSERT INTO `player` (`id`, `name`, `age`, `team_id`, `stats_id`, `created_at`, `updated_at`, `updated_by`) VALUES ('1', 'Virat Kohli', '29', '1', '1', current_timestamp(), current_timestamp(), '1'), ('2', 'pat cummins', '31', '2', '2', current_timestamp(), current_timestamp(), '1');
        // $query = "INSERT INTO team(name) VALUES ('india');";
        
        $player_name = $this->input->post('name');
        $player_age = $this->input->post('age');
        $player_jersey_no = $this->input->post('jersey_no');
        
        
        $team = $this->input->post('team');
        $team_result = $this->db->get_where('team',array('name' => $team));
        $team_exists = $team_result->num_rows() > 0 ? true : false;
        if(!$team_exists){
            $this->db->insert('team', array('name'=>$team));
            $team_id = $this->db->insert_id();
        }else{
            $team_id = $team_result->row_array()['id'];
        }

        $player_result = $this->db->get_where('player',array('jersey_no'=>$player_jersey_no, 'team_id'=> $team_id));
        if($player_result->num_rows() == 0){
            $roll = $this->input->post('roll') ?? '';
            $matches = $this->input->post('matches') ?? '';
            $runs = $this->input->post('runs') ?? '';
            $run_rate = $this->input->post('run_rate') ?? '';
            $strike_rate = $this->input->post('strike_rate') ?? '';
            $fours = $this->input->post('fours') ?? '';
            $sixes = $this->input->post('sixes') ?? '';
            $fifties = $this->input->post('fifties') ?? '';
            $hundreds = $this->input->post('hundreds') ?? '';
            $wickets = $this->input->post('wickets') ?? '';
            $wickets_strike_rate = $this->input->post('wickets_strike_rate') ?? '';
            $economy_rate = $this->input->post('economy_rate') ?? '';
            $maidens = $this->input->post('maidens') ?? '';
            $five_wickets = $this->input->post('five_wickets') ?? '';
            $catches = $this->input->post('catches') ?? '';


            $stats_query = "INSERT INTO statistics(roll, matches, runs, run_rate, 
            strike_rate, fours, sixes, fifties, hundreds, wickets, wickets_strike_rate,
            economy_rate, maidens, five_wickets, catches) VALUES('".$roll."', $matches,
            $runs, $run_rate, $strike_rate, $fours, $sixes, $fifties, $hundreds, 
            $wickets, $wickets_strike_rate, $economy_rate, $maidens, $five_wickets, 
            $catches);";

            $this->db->query($stats_query);
            $stats_id = $this->db->insert_id();
            
            // $input = $this->input->post();

            $player = array('name' => $player_name, 'age' => $player_age,'jersey_no' => $player_jersey_no, 
            'team_id'=> $team_id, 'stats_id'=> $stats_id);
            
            $this->db->insert('player',$player);
            $this->response(['Player Created successfully'], REST_Controller::HTTP_OK);
        }else{
            $player_id = $player_result->row_array()['id'];
            $this->db->update('player',array('deleted'=>0),array('id'=>$player_id));
            $this->response(['Player ReCreated successfully'], REST_Controller::HTTP_OK);
        }
        
    }

    public function index_put($id){

        $player = $this->db->get_where('player',array('id' => $id));
        if($player->num_rows() > 0){
            $player = $player->row_array();
            $team_id = $player['team_id'];
            $stats_id = $player['stats_id'];
            $player_jersey_no = $player['jersey_no'];
            $player_deleted = $player['deleted'];

            $team_name = $this->db->get_where('team',array('id'=>$team_id))->row_array()['name'];
            $statistics = $this->db->get_where('statistics', array('id' => $stats_id))->row_array();



            $player_name = $this->put('name') ?? $player['name'];
            $player_age = $this->put('age') ?? $player['age'];
            $team = $this->put('team') ?? $team_name;
            $player_jersey_no = $this->put('jersey_no') ?? $player_jersey_no;
            $player_deleted = $this->put('deleted') ?? $player_deleted;
            $roll = $this->put('roll') ?? $statistics['roll'];
            $matches = $this->put('matches') ?? $statistics['matches'];
            $runs = $this->put('runs') ?? $statistics['runs'];
            $run_rate = $this->put('run_rate') ?? $statistics['run_rate'];
            $strike_rate = $this->put('strike_rate') ?? $statistics['strike_rate'];
            $fours = $this->put('fours') ?? $statistics['fours'];
            $sixes = $this->put('sixes') ?? $statistics['sixes'];
            $fifties = $this->put('fifties') ?? $statistics['fifties'];
            $hundreds = $this->put('hundreds') ?? $statistics['hundreds'];
            $wickets = $this->put('wickets') ?? $statistics['wickets'];
            $wickets_strike_rate = $this->put('wickets_strike_rate') ?? $statistics['wickets_strike_rate'];
            $economy_rate = $this->put('economy_rate') ?? $statistics['economy_rate'];
            $maidens = $this->put('maidens') ?? $statistics['maidens'];
            $five_wickets = $this->put('five_wickets') ?? $statistics['five_wickets'];
            $catches = $this->put('catches') ?? $statistics['catches'];
            
            
            $team_result = $this->db->get_where('team',array('name' => $team));
            $team_exists = $team_result->num_rows() > 0 ? true : false;
            if(!$team_exists){
                $this->db->insert('team', array('name'=>$team));
                $team_id = $this->db->insert_id();
            }
           
            $stats = array(
                'roll' => $roll,
                'matches' => $matches,
                'runs' => $runs,
                'run_rate' => $run_rate,
                'strike_rate' => $strike_rate,
                'fours' => $fours,
                'sixes' => $sixes,
                'fifties' => $fifties,
                'hundreds' => $hundreds,
                'wickets' => $wickets,
                'wickets_strike_rate' => $wickets_strike_rate,
                'economy_rate' => $economy_rate,
                'maidens' => $maidens,
                'five_wickets' => $five_wickets,
                'catches' => $catches,
            );
            
            $player = array(
                'name' => $player_name,
                'age' => $player_age,
                'team_id' => $team_id,
                'stats_id' => $stats_id,
                'jersey_no' => $player_jersey_no,
                'deleted' => $player_deleted,
            );

            $this->db->update('statistics',$stats, array('id'=>$stats_id));
            $this->db->update('player', $player, array('id'=>$id));
            $this->response(['Player updated successfully'], REST_Controller::HTTP_OK);
        }
        

        // else{
        //     $team_id = $team_result->row_array()['id'];
        //     $this->db->update('team',array('id',$team_id));
        // }

        // $input = $this->put();

        // $this->db->update('player',$input, array('id'=>$id));

        
    }

    public function index_delete($id){
        $this->db->update('player',array('deleted'=>1), array('id' => $id));
        // $this->db->delete('player',array('id'=>$id));

        $this->response(['Player deleted successfully'], REST_Controller::HTTP_OK);
    }
}