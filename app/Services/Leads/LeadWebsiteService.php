<?php 
namespace App\Services\Leads;
 
class LeadWebsiteService {
 
    public function getPageJson()
    {
       $page_array = ['Header' => [
                            'Heading' => 'Reach Your Potential',
                            'SubText' => 'Start your Personalized fitness program today',
                            'HeaderImage' => 'assets/admin/plan-img/exercise-image1.jpg'
                            ],
                            'PlanTypes' => [1],
                            'About' => "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.",
                            'Video' => ['assets/video/07081201-Side-Crunch_Waist.mp4',
                                        'https://www.youtube.com/watch?v=tS7upsfuxmo',
                                        'https://www.youtube.com/watch?v=tS7upsfuxmo']
                        ];
        return json_encode($page_array); 
    }

    public function getGenralInfoJson($email,$phone)
    {
        $genralInfoArray = ['GeneralContact' => [
                                'Email' => $email,
                                'Phone' => $phone
                            ],
                            'SocialMedia' => [
                                'FacebookLink' =>   'https://www.facebook.com/',
                                'TwitterLink' =>    'https://twitter.com/',
                                'InstagramLink' =>  'https://www.instagram.com/'
                            ]
                           ];
        return json_encode($genralInfoArray);  
    }

    public function getFlyerJson($phone, $name)
    {
        $flyer_array = [
                'FlyerType' => 'Flyer 1',
                'HeaderImage' => 'assets/admin/plan-img/exercise-image1.jpg',
                'FlyerImage2' => 'assets/admin/plan-img/exercise-image2.jpg',
                'FlyerImage3' => 'assets/admin/plan-img/exercise-image3.jpg',
                'FlyerURL' => 'flyerdemo',
                'color' => '#fff',
                'Phone' => $phone,
                'LeadName' => $name,
                'WelcomeMessage' => 'Hi Lead Name ! The team at fitnessplanapp.com recognize you can grow your brand and want to help get you started',
                'BrandedSite' => 'Share your Brand Page with your clients to showcase your clients to Sell your Plans and Classes.',
                'APP' => 'Your clients can use your own Branded App for their fitness plans and class management.'
        ];

        return json_encode($flyer_array); 
    }


    public function getDescription(){

        return $description ='Muscular endurance refers to the ability of a muscle to sustain repeated contractions against resistance for an extended period of time. To increase muscular indurance, you should engage in activities that work your muscles more than usual such as squats, push-ups, or jumping jacks. Muscular strength relates to your ability to move and lift objects. It’s measured by how much force you can exert and how much weight you can lift for a short period of time.';

    }
 
}