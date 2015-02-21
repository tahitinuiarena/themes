<?php
class SubscriberStats{

	public	$twitter,$rss,$facebook;
	public	$services = array();

	public function __construct($arr){

		$this->services = $arr;

		// Building an array with queries:

		if(trim($arr['feedBurnerURL'])) {
            $query = 'http://feedburner.google.com/api/awareness/1.0/GetFeedData?uri='.end(split('/',trim($arr['feedBurnerURL'],'/')));
            $xml = file_get_contents($query);
            $profile = new SimpleXmlElement($xml, LIBXML_NOCDATA);
            $this->rss = (string) $profile->feed->entry['circulation'];
            //echo '#1#'.$this->rss."*";
        }
		if(trim($arr['twitterName'])) {
			$query = 'http://api.twitter.com/1/users/show.json?screen_name='.$arr['twitterName'];
            $result = json_decode(file_get_contents($query));
            //$this->twitter = $result->followers_count;
            $this->twitter = "45";
            //echo '#2#'.$this->twitter."*";
        }
		if(trim($arr['facebookFanPageURL'])) {
            $fb_id = basename($arr['facebookFanPageURL']);
			$query = 'http://graph.facebook.com/'.urlencode($fb_id);
            //echo $query;
			$result = json_decode(file_get_contents($query));
            $this->facebook = $result->likes;
        }

        //Grab Delicious
       /* $url = 'www.queness.com'; 
        $api_page = 'http://feeds.delicious.com/v2/json/urlinfo/data?url=%20www.queness.com';
        $json = file_get_contents ( $api_page );
        $json_output = json_decode($json, true);
        $data['delicious'] = $json_output[0]['total_posts'];*/
	}

	public function generate(){
		$total = number_format($this->rss+$this->twitter+$this->facebook);

        ?>
        <div id="socialCounterWidget" class="socialCounterWidget">
            <?php if($this->services['twitterName']) { ?>
            <a id="sc_twitter" class="socialCounterBox" href="http://twitter.com/<?php echo $this->services['twitterName']?>" target="_blank">
            	<span class="icon"></span>
                <span class="count"><?php echo number_format($this->twitter); ?></span>
                <span class="title"><?php _e( 'Followers' , 'crumble' ); ?></span> 

            </a>
            <?php } ?>
            <?php if($this->services['facebookFanPageURL']) {
            ?>
            <a id="sc_facebook" class="socialCounterBox" href="<?php echo $this->services['facebookFanPageURL']?>" target="_blank" title="<?php echo number_format($this->rss)?>">
            	<span class="icon"></span>
                <span class="count"><?php echo number_format($this->facebook); ?></span>
                <span class="title"><?php _e( 'Fans' , 'crumble' ); ?></span> 

            </a>
            <?php } ?>
            <?php if($this->services['feedBurnerURL']) { ?>
        	<a id="sc_rss" class="socialCounterBox" href="<?php echo $this->services['feedBurnerURL']; ?>" target="_blank">
            	<span class="icon"></span>
                <span class="count"><?php echo number_format($this->rss); ?></span>
                <span class="title"><?php _e( 'Subscribers' , 'crumble' ); ?></span> 

            </a>
            <?php } ?>
            
        </div>
       <?php
	}
}
?>
