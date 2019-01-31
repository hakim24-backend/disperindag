<?php 
 namespace backend\firebase;

class Push {
    //news id
    private $news_id;

    //notification title
    private $title;
 
    //notification message 
    private $message;
 
    //notification image url 
    private $image;
 
    //agenda
    //agenda id
    private $agenda_id;

    //agenda topic
    private $topic;

    //agenda date start
    private $date_start;

    //agenda date end
    private $date_end;

    //agenda time
    private $time;

    //agenda location
    private $location;

    //initializing values in this constructor
    public function News($id, $title, $message, $image) {
         $this->news_id = $id;
         $this->title = $title;
         $this->message = $message; 
         $this->image = $image; 
    }

    public function Agenda($id, $topic, $date_start, $date_end, $time, $location){
        $this->agenda_id = $id;
        $this->topic = $topic;
        $this->date_start = $date_start;
        $this->date_end = $date_end;
        $this->time = $time;
        $this->location = $location;
    }
    
    //getting the push notification
    public function getPush() {
        $res = array();
        $res['data']['judul'] = $this->title;
        $res['data']['message'] = $this->message;
        $res['data']['gambar_url'] = $this->image;
        $res['data']['id'] = $this->news_id;
        $res['data']['event'] = 'berita';
        return $res;
    }

    public function getPushAgenda() {
        $res = array();
        $res['data']['id'] = $this->agenda_id;
        $res['data']['topik'] = $this->topic;
        $res['data']['tanggal_mulai'] = $this->date_start;
        $res['data']['tanggal_selesai'] = $this->date_end;
        $res['data']['jam'] = $this->time;
        $res['data']['lokasi'] = $this->location;
        $res['data']['event'] = 'agenda';
        return $res;
    }


 
}

?>