<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\admin\PagesSections;

class PageSectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $homeSection = [
                            'PageContent' => [
                                    'MainHeading' => 'Home',
                                    'MenuText' => 'Home'
                            ],
                            'Section' => [
                                'HeaderBanner' => [
                                    'LabelName' => 'Header Banner',
                                    'Status' => true,
                                    'Title' => 'Create you own fitness plan app',
                                    'SubText' => 'Stay connected with your clients and future customers. They choose you not only for your fitness plans and classes, but for your accountability and motivation. Take control and streamline everything with your very own fitness plan app.',
                                    'ActionBtn' => 'Get Started!',
                                    'ActionPage' => 'register',
                                    'file' => 'assets/admin/plan-img/hero_iphone_14.jpg'

                                ],
                                'Feature' => [
                                    'LabelName' => 'Feature',
                                    'Status' => true,
                                    'Content' => [
                                        [               
                                            'Image' => 'assets/plan-img/payment-integration.jpg',
                                            'Heading' => 'Client Management',
                                            'SubHeading' => 'Manage and track client fitness plans. Deliver online classes',
                                            'ButtonLink' => 'Learn More',
                                            'ActionPage' => '1'
                                        ]
                                    ]
                                ],
                                'LivePreview' => [
                                    'LabelName' => 'Live Preview',
                                    'Status' => true,
                                    'Content' => [
                                        [
                                            'Title' => 'Coach Home Page',
                                            'Description' => 'Some quick example text to build on the card title and make up the bulk of the cards content.',
                                            'Image' => 'assets/admin/plan-img/Coach-Home.png',
                                            'ActionPage' => '1'
                                        ]
                                    ]
                                ],
                                'Pricing' => [
                                    [ 
                                        'PackageType' => 'free',
                                        'Price' => '0',
                                        'Duration' => 'Month',
                                        'UpToClients' => '1',
                                        'Storage' => '5'
                                    ],
                                    [ 
                                        'PackageType' => 'coach1',
                                        'Price' => '25',
                                        'Duration' => 'Month',
                                        'UpToClients' => '25',
                                        'Storage' => '100'
                                    ],
                                    [ 
                                        'PackageType' => 'coach2',
                                        'Price' => '50',
                                        'Duration' => 'Month',
                                        'UpToClients' => '50',
                                        'Storage' => '150'
                                    ],
                                    [ 
                                        'PackageType' => 'coach3',
                                        'Price' => '100',
                                        'Duration' => 'Month',
                                        'UpToClients' => '100',
                                        'Storage' => '250'
                                    ],
                                    [ 
                                        'PackageType' => 'coach4',
                                        'Price' => '200',
                                        'Duration' => 'Month',
                                        'UpToClients' => '200',
                                        'Storage' => '500'
                                    ]
                                ],
                                'Exercises' => [
                                    'LabelName' => 'Exercises',
                                    'Status' => true,
                                    'Image' => 'assets/admin/plan-img/AirBike.jpg',
                                    'Heading' => 'Exercise database and benefits',
                                    'Pages' => 'Exercise'
                                ],
                                'Articles' => [
                                    'LabelName' => 'Exercises',
                                    'Status' => true
                                ]
                            ]
                        ];
        $homeSectionData = json_encode($homeSection);

        $ClientManagementSectionDesc = '1. Prebuilt Fitness Plans:
Our platform empowers fitness trainers to create and offer prebuilt fitness plans to their customers. With these plans, clients can easily browse through a selection of workout programs tailored to their goals and preferences.
                                        
Easy Subscription: Clients can conveniently subscribe to their desired prebuilt fitness plan directly from the platform. This grants them access to a structured workout regimen designed by their dedicated coach.
                                        
Progress Monitoring: As a coach, you have the ability to monitor the progress of your clients enrolled in each prebuilt fitness plan. Track their achievements, provide feedback, and offer guidance to ensure they stay on track towards their fitness goals.
                                        
Printable PDF Copy: We understand the importance of flexibility. Thats why our platform allows customers to generate a printable PDF version of their prebuilt fitness plan. They can have a physical copy to reference during workouts, complementing the digital experience.
                                        
2. Customized Training Programs:
Tailor-made for clients seeking personalized guidance, our platform supports the creation of customized training programs. With this feature, fitness trainers can create individualized workout regimens to meet the unique needs and objectives of each client.
                                        
Progress Tracking:
Keep track of your clients progress through our platform. Monitor their achievements, analyze data, and make informed adjustments to their training programs to optimize results.
                                        
Communication and Support:
Foster direct communication and engagement with your clients. Offer real-time support, answer questions, and provide guidance to keep them motivated and accountable on their fitness journey.
                                        
3. Group Fitness Classes:
In addition to individualized plans, our platform facilitates the creation and management of group fitness classes. This feature allows you to offer engaging and interactive workouts to a broader audience.
                                        
Collaborative Environment:
Create a sense of community by hosting group fitness classes. Participants can connect with each other, share their progress, and provide mutual support throughout their fitness journeys.
                                        
Live or Recorded Sessions:
Conduct live group fitness classes in real-time, offering participants an immersive workout experience. Alternatively, provide recorded sessions that clients can access at their convenience, accommodating diverse schedules.
                                        
Social Interaction:
Foster interaction and engagement among participants. Encourage them to share their experiences, ask questions, and celebrate achievements together.
                                        
Our platform provides a versatile suite of services, empowering fitness trainers to offer prebuilt fitness plans, customized training programs, and engaging group fitness classes. Choose the service that best aligns with your coaching style and the needs of your clients, and embark on a successful fitness journey together.';

        $ClientManagementSection = [
                            'PageContent' => [
                                    'MainHeading' => 'Client Management',
                                    'MenuText' => 'Feature'
                            ],
                            'Section' => [
                                'Feature' => [
                                    'LabelName' => 'Feature',
                                    'Content' => [
                                            'Image' => 'assets/plan-img/payment-integration.jpg',
                                            'Heading' => 'Discover Our Service Offerings: Choose the Perfect Fit for Your Fitness Businesst',
                                            'SubHeading' => 'Prebuilt Fitness Plans:',
                                            'Description' => $ClientManagementSectionDesc,
                                            'ButtonLink' => 'Get Started',
                                            'ActionPage' => '1'
                                    ]
                                ]
                            ]
                        ];
        $clientManagementSectionData = json_encode($ClientManagementSection);

        $PersonalizeYourBrandDesc = '1. Custom Brand Website:
With Fitness Plan App, you can establish your own personal brand website, tailored to reflect your unique style and expertise. Customize your website with personalized images and text to showcase your fitness services, programs, and offerings.
                                      
Mobile-Friendly Design:
Our platform utilizes Progressive Web App (PWA) technology, ensuring that your brand website is seamlessly accessible across various mobile platforms. Engage with clients on any device, providing a consistent and user-friendly experience.

How our Apps are built
We build our mobile apps with Progressive Web App (PWA) technology, which provides a simple and efficient solution for personal trainers like you. With PWAs, you can offer your clients an easy way to have their own fitness app on any device without the need for maintaining multiple custom native apps.

PWAs allow your clients to access your app directly from their devices browser or add it to their home screen for quick and easy access. This means they can simply download your app without going through app stores and enjoy a consistent experience across smartphones, tablets, and desktops.

By leveraging the power of PWAs, you can provide your clients with a user-friendly platform to manage their workouts, track their progress, and access exercise routines. It eliminates the complexities of maintaining different versions of your app for various operating systems, making it a hassle-free solution for both you and your clients.

With PWAs, you can focus on delivering an exceptional fitness experience while ensuring your clients have a seamless and convenient way to engage with your app on any device they prefer. For more information click here

2. Coach Admin Portal:
Take control of your online presence and client interactions through our intuitive Coach Admin Portal. Manage every aspect of your website and business operations effortlessly.

Site Customization:
Tailor the look and feel of your website to align with your branding. Easily update colors, fonts, and layouts to create a visually appealing and cohesive online presence.

Client Management:
Streamline your client interactions by accessing a comprehensive suite of management tools. Create personalized fitness plans, schedule classes, and oversee client progress, all within a centralized and user-friendly environment.

3. Fitness Plan Client Portal:
Provide your customers with a dedicated Fitness Plan Client Portal, empowering them to take charge of their fitness journey.

Workout Logging and Modifications:
Clients can conveniently log their workouts, make adjustments to their plans, and track their progress. Empower them to stay accountable and motivated with a user-friendly interface.

Detailed Plan History:
Enable clients to review their workout history and monitor their improvements over time. They can easily track their achievements and stay motivated as they witness their fitness goals coming to fruition.

Class Registration:
Offer seamless class registration through the Fitness Plan Client Portal. Clients can browse your class schedule, sign up for sessions, and receive notifications to stay informed and engaged.

Build your fitness empire with Fitness Plan Apps personalized branding capabilities, robust coach admin portal, and client-centric Fitness Plan Client Portal. Elevate your online presence, streamline client management, and empower your customers on their fitness journey.';

        $PersonalizeYourBrandSection = [
                            'PageContent' => [
                                    'MainHeading' => 'Personalize Your Brand',
                                    'MenuText' => 'Feature'
                            ],
                            'Section' => [
                                'Feature' => [
                                    'LabelName' => 'Feature',
                                    'Content' => [
                                            'Image' => 'assets/plan-img/payment-integration.jpg',
                                            'Heading' => 'Personalize Your Brand: Build Your Fitness Empire with Fitness Plan App',
                                            'SubHeading' => 'Custom Brand Website',
                                            'Description' => $PersonalizeYourBrandDesc,
                                            'ButtonLink' => 'Get Started',
                                            'ActionPage' => '1'
                                    ]
                                ]
                            ]
                        ];
        $PersonalizeYourBrandSectionData = json_encode($PersonalizeYourBrandSection);

        $SeamlessPaymentIntegrationDesc = 'Option 1: Seamlessly Process Payments with Stripe Integration
Integrate Stripe into your website and enjoy a streamlined payment experience for your clients. Heres how it works:
                                        
Create a Stripe Account:
Sign up for a Stripe account and set up your payment details. Stripe provides a secure and reliable platform for processing online payments.
                                        
Integrate Stripe:
Connect your Stripe account with your website and mobile app. Our easy-to-use integration ensures a seamless payment experience for your clients.
                                        
Set Your Service Price:
Determine the price for your fitness plans or products. Set the desired amount that clients will pay when they choose your services.
                                        
User-Friendly Checkout:
When clients select your services and proceed to checkout, they will be presented with a user-friendly payment form. They can securely enter their payment information, including credit card details.
                                        
Receive Payments:
Once clients complete the payment process, the funds will be automatically transferred to your Stripe account. You can easily track and manage your earnings through your Stripe dashboard. With Stripe integration, you can offer your clients a convenient and secure way to make payments for your services. Focus on growing your business while Stripe takes care of the payment processing.

Option 2: Simplified Offline Payment Method

Select a Package:
During the checkout process, customers choose a package that suits their needs.

Receive a message during checkout:
The customer will bypass the online payment process and receive a message during checkout that once the money is paid offline the coach will clear the transaction

Offline Payment:
Customers make the payment offline, following your preferred offline payment method.

Order Approval:
As the service provider, you can easily manage orders in your portal. Review the offline payment received from the customer.

Service Access:
Once the payment is approved, customers gain immediate access to the services they have paid for through their personalized portal.

With this offline payment method, you can offer your customers flexibility while maintaining control over the payment process.';

        $SeamlessPaymentIntegrationSection = [
                            'PageContent' => [
                                    'MainHeading' => 'Seamless Payment Integration',
                                    'MenuText' => 'Feature'
                            ],
                            'Section' => [
                                'Feature' => [
                                    'LabelName' => 'Feature',
                                    'Content' => [
                                            'Image' => 'assets/plan-img/payment-integration.jpg',
                                            'Heading' => 'Flexible Payment Options to Suit Your Business Needs',
                                            'SubHeading' => 'Seamlessly Process Payments with Stripe Integration',
                                            'Description' => $SeamlessPaymentIntegrationDesc,
                                            'ButtonLink' => 'Get Started',
                                            'ActionPage' => '1'
                                    ]
                                ]
                            ]
                        ];
        $SeamlessPaymentIntegrationSectionData = json_encode($SeamlessPaymentIntegrationSection);

        $VersatileWorkoutLibraryDesc = 'Diverse Exercise Selection:
Choose from a comprehensive collection of exercises spanning various fitness disciplines and training methods. From strength training and cardio to flexibility and functional movements, youll find an extensive range of exercises to suit every clients needs and goals.

Customization Options:
Tailor each exercise to reflect your unique brand and training style. Add your own images, videos, and links to enhance the exercise descriptions and provide a branded experience for your clients. Personalize the look and feel of each exercise to align with your fitness brand.
Create Your Own Workouts:
Take your creativity to the next level by designing your own workouts within the Fitness Plan App platform. Build custom workout routines by selecting exercises from the library, arranging them in the desired order, and specifying sets, reps, and rest periods. Empower yourself with the freedom to craft workouts that perfectly align with your clients goals and preferences.
Expand the Exercise Database:
As a fitness coach, you have the flexibility to contribute to the exercise database. Share your expertise by adding new exercises and workouts to enrich the collection. By expanding the exercise database, you can further customize fitness plans and cater to a wider range of client needs.

Elevate your fitness coaching with Fitness Plan Apps Versatile Workout Library. Unlock a world of exercise options, customize exercises to align with your brand, create tailored workouts, and contribute to the growing exercise database. Personalize your clients fitness plans, inspire them with your unique training methods, and help them achieve their fitness goals effectively.';

        $VersatileWorkoutLibrarySection = [
                            'PageContent' => [
                                    'MainHeading' => 'Versatile Workout Library',
                                    'MenuText' => 'Feature'
                            ],
                            'Section' => [
                                'Feature' => [
                                    'LabelName' => 'Feature',
                                    'Content' => [
                                            'Image' => 'assets/plan-img/payment-integration.jpg',
                                            'Heading' => 'Versatile Workout Library: Unleash Your Creativity and Build Custom Fitness Plans',
                                            'SubHeading' => 'Diverse Exercise Selection',
                                            'Description' => $VersatileWorkoutLibraryDesc,
                                            'ButtonLink' => 'Get Started',
                                            'ActionPage' => '1'
                                    ]
                                ]
                            ]
                        ];
        $VersatileWorkoutLibrarySectionData = json_encode($VersatileWorkoutLibrarySection);

        $SignupSection = [
                            'PageContent' => [
                                    'MainHeading' => 'Signup',
                                    'MenuText' => 'Signup'
                            ],
                            'Section' => [
                                'Signup' => [
                                    'LabelName' => 'Signup',
                                    'Content' => [
                                            'Image' => 'assets/admin/plan-img/AirBike.jpg'
                                    ]
                                ]
                            ]
                        ];
        $SignupSectionData = json_encode($SignupSection);

        $ExerciseDatabaseSection = [
                            'PageContent' => [
                                    'MainHeading' => 'Exercise Database',
                                    'MenuText' => 'Exercise Database'
                            ],
                            'Section' => [
                                'ExerciseDatabase' => [
                                    'LabelName' => 'Exercise Database'
                                ]
                            ]
                        ];
        $ExerciseDatabaseSectionData = json_encode($ExerciseDatabaseSection);

        $TermsSection = [
                            'PageContent' => [
                                    'MainHeading' => 'TermsSection',
                                    'MenuText' => 'Terms'
                            ],
                            'Section' => [
                                'Terms' => [
                                    'LabelName' => 'Terms',
                                    'Content' => [
                                            'Title' => '',
                                            'Description' => 'Muscular endurance refers to the ability of a muscle to sustain repeated contractions against resistance for an extended period of time. To increase muscular indurance, you should engage in activities that work your muscles more than usual such as squats, push-ups, or jumping jacks. Muscular strength relates to your ability to move and lift objects. It’s measured by how much force you can exert and how much weight you can lift for a short period of time.'
                                    ]
                                ]
                            ]
                        ];
        $TermsSectionData = json_encode($TermsSection);

        $PrivacySection = [
                            'PageContent' => [
                                    'MainHeading' => 'Privacy',
                                    'MenuText' => 'Privacy'
                            ],
                            'Section' => [
                                'Privacy' => [
                                    'LabelName' => 'Privacy',
                                    'Content' => [
                                            'Title' => '',
                                            'Description' => 'Muscular endurance refers to the ability of a muscle to sustain repeated contractions against resistance for an extended period of time. To increase muscular indurance, you should engage in activities that work your muscles more than usual such as squats, push-ups, or jumping jacks. Muscular strength relates to your ability to move and lift objects. It’s measured by how much force you can exert and how much weight you can lift for a short period of time.'
                                    ]
                                ]
                            ]
                        ];
        $PrivacySectionData = json_encode($PrivacySection);

        $FooterSection = [
                            'PageContent' => [
                                    'MainHeading' => 'FooterSection',
                                    'MenuText' => 'Footer'
                            ],
                            'Section' => [
                                'Footer' => [
                                    'LabelName' => 'Footer',
                                    'Content' => [
                                            'Facebook' => '',
                                            'Twitters' => '',
                                            'Instagram' => ''
                                    ]
                                ]
                            ]
                        ];
        $FooterSectionData = json_encode($FooterSection);

        $PagesSections = [
            [
             'page_cms_id' => 1,
             'section_id' => '1',
             'page_section_data' => $homeSectionData,
             'status' => 1
            ],
            [
             'page_cms_id' => 2,
             'section_id' => '1',
             'page_section_data' => $clientManagementSectionData,
             'status' => 1
            ],
            [
             'page_cms_id' => 3,
             'section_id' => '1',
             'page_section_data' => $PersonalizeYourBrandSectionData,
             'status' => 1
            ],
            [
             'page_cms_id' => 4,
             'section_id' => '1',
             'page_section_data' => $SeamlessPaymentIntegrationSectionData,
             'status' => 1
            ],
            [
             'page_cms_id' => 5,
             'section_id' => '1',
             'page_section_data' => $VersatileWorkoutLibrarySectionData,
             'status' => 1
            ],
            [
             'page_cms_id' => 6,
             'section_id' => '1',
             'page_section_data' => $SignupSectionData,
             'status' => 1
            ],
            [
             'page_cms_id' => 7,
             'section_id' => '1',
             'page_section_data' => $ExerciseDatabaseSectionData,
             'status' => 1
            ],
            [
             'page_cms_id' => 8,
             'section_id' => '1',
             'page_section_data' => $TermsSectionData,
             'status' => 1
            ],
            [
             'page_cms_id' => 9,
             'section_id' => '1',
             'page_section_data' => $PrivacySectionData,
             'status' => 1
            ],
            [
             'page_cms_id' => 10,
             'section_id' => '1',
             'page_section_data' => $FooterSectionData,
             'status' => 1
            ]
            ];

            foreach ($PagesSections as $data) {
                PagesSections::create($data);
            }
    }
}
