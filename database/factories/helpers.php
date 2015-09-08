<?php

if(! function_exists('branches'))
{
    function branches($key = null)
    {
        $branches =
            [
                'Lamki',
                'Dhangadhi',
                'Mahendranagar',
                'Thamel',
                'Singhadurbar',
                'Baitadi',
                'Mugu',
                'Lamahi',
                'Darchula',
                'Bajhang',
                'Bajura',
                'Dailekh',
                'Manma',
                'Mangelsen',
                'Kalanki',
                'Baglunbazar',
                'Nepalgunj',
                'Koholpur',
                'Surket',
                'Jhapa',
                'Morang',
                'Khairentar',
                'Amarsingchowk',
                'Prithivichowk',
                'Kalanki',
                'Balaju',
                'Baneshower',
                'Thapathali',
                'Pulchowk',
                'lalitpur',
                'Kirtipur',
                'Pharping',
                'Jorpati',
                'Maitidevi',
                'Tangal',
                'Besisahar'
            ];
        if(array_key_exists($key, $branches)) return $branches[$key];

    return $branches;
    }
}

if(!function_exists('designations'))
{
    function designations($key = null)
    {
        $designations = [
                    'Assistant Third',
                    'Assistant Fourth',
                    'Assitant Fourth (Computer Assistant)',
                    'Assistant Fifth',
                    'Assistant Firth (Senior)',
                    'Assistant Manager',
                    'Deputy Manager',
                    'Senior Manager',
                    // 'Deputy Department Chief',
                    // 'Department Chief',
                    // 'Assitant General Manager',
                    // 'General Manager',
            ];
      if(array_key_exists($key, $designations)) return $designations[$key];
      return $designations;
    }
}