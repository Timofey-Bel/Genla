<?php

/*
|--------------------------------------------------------------------------
| Genla — тексты (EN)
|--------------------------------------------------------------------------
| Весь словесный контент сайта. Структура (slug, сетка, картинки, настройки)
| остаётся в config/genla.php. Genla::lab() мёржит структуру с этими текстами
| по текущей локали. Английская версия — в lang/en/genla.php (та же структура).
|
| Страницы и лаборатории описаны блоками (sections) — см. components/blocks.
| Строки могут содержать **жирный** текст: выводится через Genla::md().
*/

return [
    'errors' => [
        'home' => 'Back to home',
        'ai' => 'Open Genla AI',
        '404' => ['title' => 'Page not found', 'text' => 'This page does not exist or has been moved. Check the address or go back to the homepage.'],
        '403' => ['title' => 'Access denied', 'text' => 'You do not have permission to view this page.'],
        '419' => ['title' => 'Session expired', 'text' => 'The page expired due to inactivity. Refresh it and try again.'],
        '429' => ['title' => 'Too many requests', 'text' => 'You are sending requests too quickly. Please wait a moment and retry.'],
        '500' => ['title' => 'Something went wrong', 'text' => 'An error occurred on our side. We are already looking into it — please try again later.'],
        '503' => ['title' => 'Under maintenance', 'text' => 'The site is temporarily unavailable and will be back shortly. Please check again soon.'],
    ],

    'company' => [
        'name' => 'Genla',
        'full_name' => 'Genla',
        'tagline' => 'Decentralised platform and systems integrator',
        'mission' => 'Genla\'s mission is to unite human potential with advanced technology to achieve extraordinary results in life, career and business.',
        'mission_short' => 'We unite human potential with advanced technology to achieve extraordinary results in life, career and business.',
        'city' => 'Moscow',
        'address' => '2nd Vyazovsky Proezd 10, bld. 2, Moscow 109428, Russia',
    ],

    'actions' => [
        'consultation' => 'Book a consultation',
        'presentation' => 'Get a presentation',
        'call' => 'Request a call',
        'contact' => 'Contact us',
        'chat' => 'Discuss now',
        'partner' => 'Partnership application',
    ],

    // Interface strings (blade).
    'ui' => [
        'cta_consultation' => 'Book a consultation',
        'cta_presentation' => 'Get a presentation',
        'cta_call' => 'Request a call',
        'cta_chat' => 'Discuss now',
        'cta_ai' => 'Start a dialogue',
        'back_to_os' => 'Back',
        'open_menu' => 'Open menu',
        'close_menu' => 'Close menu',
        'menu' => 'Menu',
        'ai_start' => 'Start a dialogue',
        'ai_open_aria' => 'Open Genla — start a dialogue',
        'lab_eyebrow' => 'Lab',
        'mission' => 'Mission',
        'about_lab' => 'About the lab',
        'audiences_title' => 'What you get',
        'faq_title' => 'Frequently asked questions',
        'lab_cta_title' => 'Let\'s discuss your task',
        'lab_cta_chat' => 'Discuss now',
        'footer_cta_lead' => 'Tell us about your task. You can book a consultation, request a presentation or discuss your question with Genla\'s digital representative right now.',
        'nav_quick' => 'Quick navigation',
        'tab_home' => 'Home',
        'tab_contact' => 'Contact',
        'lang_switch' => 'Change language',
        'footer_back' => 'To the home page',
        'privacy' => 'Personal data processing',
        'nav_about' => 'About',
        'nav_mission' => 'Mission',
        'nav_capabilities' => 'Capabilities',
        'nav_cases' => 'Cases',
        'nav_partners' => 'Partners',
        'legal_disclaimer' => 'The information on this website is provided for reference only, reflects the results of specific integration projects and is not a public offer as defined by Article 437 of the Civil Code of the Russian Federation. All calculations, partner programme terms and economic indicators are individual for each project and are set out only in bilateral agreements.',
        'menu_directions' => 'Labs',
        'back' => 'Back',
        'to_site' => 'To the website',
    ],

    // The four audiences — identical on every page.
    'audiences' => [
        'Company employee or independent professional',
        'Sole proprietor or solopreneur',
        'Startup or project team',
        'Executive or representative of a large organisation',
    ],

    'about' => [
        'seo_title' => 'Genla: a decentralised platform and systems integrator',
        'seo_description' => 'Genla brings together around 100 available specialists and a community of around 1,000 experts. AI, software development and infrastructure with unified management and data control.',
        'hero' => [
            'title' => 'Genla',
            'subtitle' => 'A decentralised platform and systems integrator',
            'paragraphs' => [
                'We help employees, independent professionals, entrepreneurs and organisations work more effectively with artificial intelligence, software solutions and computing infrastructure.',
                'We combine international expertise, our own developments and the work of specialised teams. You get direct access to the specialists and resources you need, unified project management and control over your data.',
            ],
            'stats' => [
                ['value' => 'Around 100 specialists', 'text' => 'permanently available to form project teams.'],
                ['value' => 'Around 1,000 members', 'text' => 'in an international community of experts and specialists.'],
                ['value' => '8 labs', 'text' => 'research, development and practical solutions for people and businesses.'],
            ],
        ],
        'sections' => [
            [
                'title' => 'Who we are',
                'paragraphs' => [
                    'Genla is an alliance of professionals and a collaboration platform for developers, engineers, researchers, industry experts and seasoned IT leaders.',
                    'Our company has a horizontal structure. Specialists and teams keep their professional independence and come together around a specific client task. Genla organises their collaboration, designs the overall architecture, controls quality and is accountable for delivering on agreed commitments.',
                    'Around 100 specialists across a range of narrow fields are permanently available on the platform. A wider community brings together around 1,000 members from Russia, Belarus, China, the Netherlands, India and other countries. It extends access to knowledge, rare expertise and experience of solving problems across industries.',
                    'We build each team around the nature of the task, the specialists\' experience, their availability and security requirements. For the client, everything works through a single window: one point of contact, an agreed plan and clear accountability from Genla for the project.',
                ],
            ],
            [
                'title' => 'How our platform works',
                'paragraphs' => [
                    'Clients get direct access to the specialists and resources of the ecosystem, without a chain of intermediaries. The relevant experts can discuss the task with you, explain their decisions and take your feedback into account as the work progresses.',
                    'Genla provides everything needed for a shared result: team selection, project management, decision alignment, information access control and quality assurance. The project manager ties the participants\' work together, manages timelines and helps the client make decisions.',
                    'This model makes it possible to bring in rare expertise at the right stage, quickly change the team as the task evolves and use available resources without having to keep every specialisation on staff.',
                ],
                'footer' => 'Decentralisation shapes how we collaborate. Project management, access rules and accountability remain unified.',
            ],
            [
                'title' => 'Why Genla is a systems integrator',
                'paragraphs' => [
                    'We connect software products, AI models, data, hardware, infrastructure and business processes into a system that solves the client\'s problem.',
                    'For example, automating the preparation of commercial proposals may require access to current terms, document handling, integration with an accounting system, approval rules and protection of client information. Genla designs the entire process and verifies how its parts work together.',
                    'Our expertise covers problem analysis, design, development, infrastructure selection and setup, implementation, security assessment and support. To deliver, we use our own developments, suitable partner products and the expertise of platform members.',
                    'The client receives a coherent result with clear stages and acceptance criteria. Genla takes on the coordination of specialists and the compatibility of solutions, and after implementation helps the team master the system and develop it within the agreed scope.',
                ],
            ],
            [
                'title' => 'What this means for the client',
                'layout' => 'cards',
                'cols' => 2,
                'items' => [
                    [
                        'title' => 'International expertise',
                        'paragraphs' => [
                            'Your task can draw on the knowledge of specialists from different countries and professional fields. We can combine engineering experience, a scientific approach and practical business understanding, selecting participants to match the project requirements.',
                        ],
                    ],
                    [
                        'title' => 'Cost-effective pricing',
                        'paragraphs' => [
                            'You bring in specialists and resources in the amount you need. Direct interaction cuts the costs of handing tasks between contractors, while the use of suitable ready-made components and Genla\'s own tools reduces repeated development and routine work.',
                            'When planning, we take into account the costs of implementation, ongoing operation and development. Our aim is to minimise unnecessary costs while maintaining the agreed quality, security and result. The cost of work, resources and project management is set out in the proposal.',
                        ],
                    ],
                    [
                        'title' => 'Speed',
                        'paragraphs' => [
                            'A permanent pool of specialists helps us assemble a team faster. Direct communication with the people doing the work removes intermediate approvals, and phased delivery lets you confirm the value of a solution before scaling it.',
                        ],
                    ],
                    [
                        'title' => 'A single window',
                        'paragraphs' => [
                            'You do not need to coordinate developers, engineers, data and security specialists yourself. Genla brings their work together, manages the project and ensures a clear process of interaction, from the first discussion to ongoing support.',
                        ],
                    ],
                ],
            ],
            [
                'title' => 'International expertise and data control',
                'paragraphs' => [
                    'Client sovereignty is one of the architectural requirements for our solutions. By this we mean the ability to manage your own infrastructure, corporate knowledge, data access and the rules by which intelligent systems operate.',
                    'International participation is organised within the rules of each specific project. A specialist\'s access is determined by their task, their authority and the client\'s approval. Membership in the community does not in itself grant access to client systems or information.',
                    'Within a project, we build control at several levels:',
                ],
                'layout' => 'list',
                'items' => [
                    '**Data location.** We determine where data may be stored and processed, which services are permitted and what restrictions apply to data transfer. If required, we deploy the solution on the client\'s hardware or in a dedicated environment.',
                    '**Access rights.** We grant access for a specific role and task, limit the permissions of people and digital employees, and review them as work is completed.',
                    '**Environment separation.** We keep development and testing separate from production systems. For tasks that do not need original client data, we use prepared, anonymised or synthetic datasets.',
                    '**Activity monitoring.** We set up logging of significant events, monitoring of connected systems and a procedure for responding to detected risks.',
                    '**Change management.** We agree on new connections, updates and any expansion of permissions. Critical actions follow established rules and involve the responsible people.',
                ],
                'after' => [
                    'For these tasks, we use Genla\'s own developments, including tools for controlling data and the behaviour of intelligent systems, together with the necessary infrastructure protection mechanisms. The scope of protection is determined by the project\'s architecture and risks.',
                    'For projects with special requirements, we take into account restrictions related to national security, permitted team composition, infrastructure location and external dependencies. Confidentiality, access and liability terms are set out in the project documents.',
                ],
                'footer' => 'The client should know where their data is, who works with it and how the system\'s operation is controlled.',
            ],
            [
                'title' => 'What our expertise is built on',
                'paragraphs' => [
                    'Genla runs eight labs. Each develops its own area of expertise and practical solutions for clients:',
                ],
                'layout' => 'list',
                'items' => [
                    '**GenReview**: research, audit, consulting and choosing a well-founded development path.',
                    '**GenClaw**: autonomous digital employees for personal and business tasks.',
                    '**GenPromo**: communications, marketing, personalised content and analytics.',
                    '**GenFleet**: Genla hardware and ready-to-use computing systems.',
                    '**GenCloud**: cloud resources, secure workstations and corporate environments.',
                    '**GenType**: digital genetics and the authenticity of intelligent systems.',
                    '**GenSec**: security for people, data and systems; development of GenSec AI.',
                    '**GenX**: research and data collection for training the robotics of the future.',
                ],
                'after' => [
                    '**GenType is Genla\'s main lab and our core research competence.** We develop approaches that help intelligent systems preserve their principles, professional traits and quality of work as models are updated and contexts change.',
                    'We believe that sustainable AI development requires systems that can stay true to their purpose, take feedback into account and do their job well. That is why we combine software engineering with research into language, behaviour and governance. In our research, we collaborate with academic and non-profit organisations.',
                ],
            ],
            [
                'title' => 'What you get',
                'layout' => 'audiences',
                'cols' => 2,
                'items' => [
                    [
                        'title' => 'Company employee or independent professional',
                        'paragraphs' => [
                            'We help you work out which tools are useful in your particular job: for finding and analysing information, preparing documents, communication and repetitive operations. We select and configure solutions, and explain how to apply them to real tasks and assess the quality of their output.',
                            'You get a practical way to cut routine work, raise the quality of your output and free up time for tasks where your experience and independent judgement matter most. When working with corporate information, we follow your organisation\'s rules and respect your level of authority.',
                        ],
                    ],
                    [
                        'title' => 'Sole proprietor or solopreneur',
                        'paragraphs' => [
                            'We help you organise sales, communication, content preparation and request handling to suit your scale and budget. We determine what can be automated, where a ready-made product is enough and which work is best handed to a digital employee or a specialist.',
                            'You get access to expertise and infrastructure without having to build a large permanent team. The solution can be developed in stages as your clients and tasks grow, while you stay in control of your costs and your business.',
                        ],
                    ],
                    [
                        'title' => 'Startup or project team',
                        'paragraphs' => [
                            'We help you test an idea, define the first useful version of the product, choose the architecture and assemble a team to build it. We bring in the expertise needed for the prototype, pilot, infrastructure, security and reaching your audience.',
                            'You get a clear plan for testing hypotheses and building the product, along with the option to bring in specialists for individual stages. This helps you get user feedback sooner and direct your budget towards the project\'s confirmed needs.',
                        ],
                    ],
                    [
                        'title' => 'Executive or representative of a large organisation',
                        'paragraphs' => [
                            'We help connect individual initiatives with the organisation\'s goals: raising productivity, preserving corporate knowledge, reducing costs and ensuring controlled use of AI. We study existing processes and systems, design the changes, run a pilot and organise the rollout.',
                            'You get unified project coordination, access to rare expertise and agreed success criteria. Requirements for data, infrastructure, access, business continuity and ongoing support are taken into account during design and delivery.',
                        ],
                    ],
                ],
            ],
            [
                'title' => 'Our approach',
                'paragraphs' => [
                    'At the centre of our work are people: their goals, professional independence and quality of life. We aim to free up time spent on repetitive tasks, help people make well-founded decisions and create more of value.',
                    'We judge a solution by what changes in the work: how much time it saves and how it affects quality, costs, security and growth opportunities. We choose the criteria together with the client.',
                    'We start by understanding the task. Sometimes the best next step is to change a process, configure an existing tool or postpone a purchase. If new development is not needed, we say so directly.',
                    'Clients should retain their independence: understand the decisions made, have the necessary access and documentation, and know the terms of support and further development. The procedure for handing over results and the rights to them are agreed within the project.',
                ],
            ],
            [
                'title' => 'How to start working with us',
                'layout' => 'steps',
                'items' => [
                    [
                        'title' => 'We discuss your task',
                        'paragraphs' => ['We find out what you want to improve, what resources you already have and what constraints need to be considered.'],
                    ],
                    [
                        'title' => 'We identify useful changes',
                        'paragraphs' => ['You can start with a free basic audit. For complex tasks, we agree on an in-depth study with detailed analysis.'],
                    ],
                    [
                        'title' => 'We propose a solution',
                        'paragraphs' => ['We define the scope of work, team, architecture, timelines, budget and acceptance criteria.'],
                    ],
                    [
                        'title' => 'We build and test',
                        'paragraphs' => ['We complete the agreed stages, present the results and test the solution against your real work scenarios.'],
                    ],
                    [
                        'title' => 'We hand over and support',
                        'paragraphs' => ['We help you master the system and organise its ongoing support within the agreed scope.'],
                    ],
                ],
            ],
            [
                'title' => 'Frequently asked questions',
                'layout' => 'faq',
                'items' => [
                    ['q' => 'Is Genla a company or a community of specialists?', 'a' => 'Genla is a company, a decentralised collaboration platform and a systems integrator. The community extends access to expertise. For your project, Genla forms a specific team, organises its work and is accountable for the agreed commitments.'],
                    ['q' => 'Who is responsible for the result in a horizontal model?', 'a' => 'When a project is delivered through Genla, the client has a single point of accountability: Genla, an assigned project manager and an agreed process of interaction. Participants\' roles, the scope of work, timelines and acceptance criteria are fixed before the relevant stages begin.'],
                    ['q' => 'Will all community members get access to our data?', 'a' => 'No. Community membership does not grant such access. Only selected specialists join the project, with the permissions they need for their tasks. Access conditions and information handling rules are determined by the client\'s requirements and the project rules.'],
                    ['q' => 'Can we use international expertise while keeping our data inside the company?', 'a' => 'Yes, if the architecture and scope of work allow the expert task to be separated from access to the original data. For example, a specialist can work with a task description, anonymised materials or a test environment. For closed parts of the project, we restrict the team composition and connection methods. These conditions are defined before work begins.'],
                    ['q' => 'What makes the project less expensive?', 'a' => 'The team is assembled for the required scope of work. Specialists interact directly, ready-made components are used where it makes sense, and our own tools cut routine operations. This helps reduce organisational and duplicated costs. The final cost depends on the task and on the requirements for quality, security, timelines and support.'],
                    ['q' => 'Can we keep our existing software, hardware and infrastructure?', 'a' => 'Yes. We first assess your existing resources and whether they can be used. We propose changes only where they are needed to achieve the goal. If required, we deploy the solution on the client\'s hardware or in a dedicated environment.'],
                    ['q' => 'Do we need to order development or buy hardware right away?', 'a' => 'No. You can start with a consultation and a free basic audit. Its purpose is to identify useful next steps. The outcome may be configuring existing tools, changing a process, running a pilot or a recommendation to postpone new investment.'],
                ],
            ],
        ],
        'closing' => [
            'title' => 'Let\'s start with your task',
            'text' => 'Tell us what you want to improve in your work, project or organisation. We will help you assess the possibilities, define the next step and find the resources you need.',
        ],
    ],

    'mission_page' => [
        'seo_title' => 'Genla\'s mission: human potential and organisational independence',
        'seo_description' => 'Genla\'s mission is to combine human potential with advanced technology to achieve extraordinary results in life, career and business. Human capabilities, sovereignty, leadership.',
        'hero' => [
            'title' => 'Mission',
            'paragraphs' => [
                '**Genla\'s mission is to combine human potential with advanced technology to achieve extraordinary results in life, career and business.**',
                'We create systems, products and solutions that expand human capabilities, improve quality of life and make organisations more effective.',
                'By strengthening technological sovereignty, we help our partners become drivers of progress and lasting leaders in their industries.',
            ],
        ],
        'sections' => [
            [
                'title' => 'We start with people',
                'paragraphs' => [
                    'Behind every work task is a person: their time, attention, knowledge, responsibility and desire to do something useful. That is why our starting point is understanding what they need to change and what result will genuinely improve their situation.',
                    'We help reduce repetitive operations, simplify access to knowledge and free up time for meaningful work. We want new tools to help people develop their skills, make well-founded decisions and act with more confidence in a changing world.',
                    'For us, quality of life also concerns what happens outside work: whether people still have the energy and time for family, creativity, relationships and personal growth. We want gains in efficiency to give people more freedom to shape their own lives.',
                ],
            ],
            [
                'title' => 'The future we want to build',
                'paragraphs' => [
                    'We are working towards a future in which access to strong expertise and modern tools helps more people bring their ideas to life. An independent professional can take on more complex tasks, an entrepreneur can grow their business, a small team can create products people want, and a large organisation can change in a meaningful and well-managed way.',
                    'In this future, people set the goals, values and acceptable limits for the use of artificial intelligence. Intelligent systems help achieve these goals, take feedback into account and remain under the control of those whose interests they serve.',
                    'We believe it is important to preserve the diversity of professional approaches, cultures and knowledge systems. People and organisations should be able to develop their own intelligent environment that fits their tasks, principles and responsibilities.',
                ],
            ],
            [
                'title' => 'The principles that guide us',
                'layout' => 'cards',
                'cols' => 3,
                'items' => [
                    [
                        'title' => 'Value for people',
                        'paragraphs' => ['We judge a solution by the changes it brings to real work and life. We take into account people\'s time, experience, personal boundaries and ability to make their own decisions. Every automation comes with clear rules of use and verification of results.'],
                    ],
                    [
                        'title' => 'Honesty in choosing solutions',
                        'paragraphs' => ['We start with the goal and the existing resources. We explain the possibilities and limitations of the proposed approaches. If a task can be solved by configuring an existing tool or changing a process, we recommend that path. Any new purchase or development must be justified.'],
                    ],
                    [
                        'title' => 'Independence and sovereignty',
                        'paragraphs' => ['We help clients retain control over their data, knowledge, infrastructure and the rules by which intelligent systems operate. We account for dependencies on vendors and external services, and provide the necessary documentation and clear terms for the future development of the solution.'],
                    ],
                    [
                        'title' => 'Security and responsibility',
                        'paragraphs' => ['We see security as protecting people, their information, resources and professional activity. We define system permissions, access rules and actions that require the involvement of a responsible person. We test solutions under the conditions in which they will be used and address the risks identified.'],
                    ],
                    [
                        'title' => 'Collaboration and respect for contribution',
                        'paragraphs' => ['We bring independent professionals together around a shared task. We encourage direct interaction, knowledge sharing and mutual accountability. We respect authorship, intellectual property and agreements between participants.'],
                    ],
                    [
                        'title' => 'Growth through feedback',
                        'paragraphs' => ['We compare expected results with actual ones, analyse mistakes and refine our solutions. Research and engineering help us test hypotheses, build experience and improve systems as tasks evolve.'],
                    ],
                ],
            ],
            [
                'title' => 'What this means for you',
                'layout' => 'audiences',
                'cols' => 2,
                'items' => [
                    [
                        'title' => 'Company employee or independent professional',
                        'paragraphs' => [
                            'We help you do higher-quality work and free your time from routine: searching for information, re-preparing materials, transferring data and other repetitive actions. We explain how to use the right tools, check their output and apply your own experience where it matters most.',
                            'For us, a meaningful result is when you gain more professional independence, more opportunities for growth and more time for the tasks you find meaningful.',
                        ],
                    ],
                    [
                        'title' => 'Sole proprietor or solopreneur',
                        'paragraphs' => [
                            'We help you get more out of limited time and budget. Access to specialists, digital employees and infrastructure lets you organise client work, proposal preparation and other processes as your business needs them.',
                            'For us, a meaningful result is when you manage your workload better, understand your costs and can devote more attention to your product, your clients and growing your business.',
                        ],
                    ],
                    [
                        'title' => 'Startup or project team',
                        'paragraphs' => [
                            'We help turn an idea into a testable hypothesis and a working product: define a useful first step, bring in the right expertise and get feedback from users. We keep an eye on the project\'s economics and on the team\'s independence in decision-making.',
                            'For us, a meaningful result is when the team gets a well-founded development path, spots mistakes earlier and directs resources to what creates real value for users.',
                        ],
                    ],
                    [
                        'title' => 'Executive or representative of a large organisation',
                        'paragraphs' => [
                            'We help raise the organisation\'s effectiveness with due regard for people, processes, corporate knowledge and security requirements. We design changes so that they can be managed, their value can be verified and the solutions can grow along with the tasks.',
                            'For us, a meaningful result is when the organisation operates more resiliently, employees get useful tools and management retains control over data, infrastructure and key decisions.',
                        ],
                    ],
                ],
            ],
            [
                'title' => 'Why we chose a horizontal model',
                'paragraphs' => [
                    'To fulfil this mission, Genla is developing as a decentralised platform and systems integrator. Horizontal collaboration lets us bring together the knowledge and experience of independent specialists, researchers and teams around a specific task.',
                    'We aim to make strong expertise more accessible: we arrange direct interaction with professionals, bring in resources on demand and cut unnecessary costs of passing tasks between participants. Genla provides coordination, consistency of decisions and accountability for the commitments made.',
                    'International cooperation expands what this alliance can achieve. At the same time, information handling follows the requirements of each specific project: the client defines acceptable access conditions and retains the necessary control over their data.',
                ],
            ],
            [
                'title' => 'Intelligent systems that stay true to their purpose',
                'paragraphs' => [
                    'We see one of the key challenges in AI development as a system\'s ability to consistently perform its intended work: to preserve its core principles, take feedback into account and maintain quality as the context changes and models are updated.',
                    'This challenge is the focus of **GenType, Genla\'s main lab**. We are developing digital genetics: approaches to shaping and preserving the unique properties of intelligent systems, their professional traits and their value orientations.',
                    'By authenticity, we mean that a system\'s actual behaviour matches its purpose and principles. This requires research, verification and consistent development. We are convinced that this work is essential for building cybernetic systems that receive feedback, evaluate results and adjust their actions in people\'s interests.',
                ],
            ],
            [
                'title' => 'How we measure the value of our work',
                'paragraphs' => [
                    'Before implementation, we agree with the client on what should change. Depending on the task, we assess:',
                ],
                'layout' => 'list',
                'items' => [
                    '**Time and workload:** how much manual work has been eliminated and which tasks a person can now complete faster.',
                    '**Quality:** whether there are fewer errors, rework and information losses.',
                    '**Economics:** how the costs of performing the task, operating the solution and developing it have changed.',
                    '**Independence:** whether the client can understand how the system works, manage it and make informed choices about next steps.',
                    '**Security and resilience:** how clear and verifiable the access rights, system actions and failure response procedures are.',
                ],
                'after' => [
                    'It matters to us that the value lasts in day-to-day work. That is why we take user experience into account after implementation and use it for further improvements.',
                ],
            ],
            [
                'title' => 'Frequently asked questions',
                'layout' => 'faq',
                'items' => [
                    ['q' => 'What do you mean by extraordinary results?', 'a' => 'By extraordinary results we mean a qualitative expansion of capabilities: a person handles tasks that were previously beyond their reach, a team creates a new product, or an organisation enters a new field or significantly improves the quality of its work. For each project, we set specific goals and check the result against agreed metrics.'],
                    ['q' => 'What does Genla\'s human-centred approach mean?', 'a' => 'People define the goal and the criteria for a system\'s usefulness. When choosing solutions, we consider their tasks, independence, safety and working conditions. Significant decisions, and responsibility for them, remain within the authority of people and the organisation.'],
                    ['q' => 'How is greater efficiency connected to quality of life?', 'a' => 'Reducing repetitive operations can free up time and ease excessive workload. We aim to help people direct these resources towards meaningful work, personal growth and their private lives. The specific effect depends on the task and on how the solution is used.'],
                    ['q' => 'Why is client independence important to you?', 'a' => 'People and organisations should understand how their data is used, what dependencies arise and who makes the decisions. We help put the necessary controls in place and agree on the terms for operating and developing the system in advance.'],
                    ['q' => 'How does the mission shape the proposal a client receives?', 'a' => 'We start with the need and assess the value of the changes. A proposal may include consulting, configuring existing tools, a ready-made product or custom development. If implementation is not advisable right now, we explain why and suggest a well-founded next step.'],
                    ['q' => 'Where can we start?', 'a' => 'With a discussion of your task and a free basic audit. This helps set priorities and understand which changes are worth considering. For tasks that require in-depth research, we agree on an extended audit separately.'],
                ],
            ],
        ],
        'closing' => [
            'title' => 'Start with what matters to you',
            'text' => 'Tell us what you want to change in your work, project or organisation. Together we will define what result would be valuable for you and where to begin.',
        ],
    ],

    'capabilities' => [
        'seo_title' => 'Genla capabilities: hardware assembly, data centre and systems integration',
        'seo_description' => 'An assembly workshop and warehouse in China, a hardware warehouse in Russia, our own data centre and Genla teams. Hardware, products, services and systems integration.',
        'hero' => [
            'title' => 'Capabilities',
            'subtitle' => 'Hardware, infrastructure and teams for your goals',
            'paragraphs' => [
                'Genla brings together its own assembly workshop and warehouse in China, a hardware warehouse in Russia, its own data centre, research groups, engineers, developers and marketing specialists. These resources allow us to build end-to-end systems, supply ready-made products and hardware, and provide individual services.',
                'You choose the scale of cooperation you need, from a single task to the long-term development of your infrastructure, product or business. We select the resources, organise the work and take responsibility for the agreed result.',
            ],
        ],
        'sections' => [
            [
                'title' => 'Resources you can rely on',
                'layout' => 'cards',
                'cols' => 2,
                'items' => [
                    [
                        'title' => 'Assembly workshop and hardware warehouses',
                        'paragraphs' => [
                            'Genla has its own assembly workshop and warehouse in China, as well as a hardware warehouse in Russia. We select components for the client\'s needs, assemble servers and computing systems, and configure and test them before handover. Our design bureau in Russia helps engineer configurations around workload, deployment conditions and future upgrade options.',
                            'You receive hardware prepared for your work, with an agreed scope of delivery and support terms. If required, we pre-install the software environment, models and application services.',
                        ],
                    ],
                    [
                        'title' => 'Our own data centre',
                        'paragraphs' => [
                            'Genla operates its own data centre and computing infrastructure for hosting servers, applications, data and intelligent systems. We provide virtual resources, dedicated servers and capacity for AI workloads, and build corporate cloud environments.',
                            'You can use our resources, host the solution on your own hardware or combine several environments. Performance, access, backup and support are defined by the project requirements.',
                        ],
                    ],
                    [
                        'title' => 'Research groups',
                        'paragraphs' => [
                            'Researchers and scientists help with tasks that require testing new approaches. We formulate hypotheses, study data, build experimental solutions and assess their applicability before large-scale deployment.',
                            'Our research areas include the digital genetics of intelligent systems, model training and fine-tuning, feedback in cybernetic systems, and data for training robotics. We collaborate with academic and non-profit organisations.',
                        ],
                    ],
                    [
                        'title' => 'Engineers and developers',
                        'paragraphs' => [
                            'The platform brings together specialists in software engineering, artificial intelligence, data, infrastructure and information security. Their expertise allows us to build applications, integrate corporate systems, deploy models, configure digital employees and run solutions in production.',
                            'Around 100 specialists are permanently available to form project teams. An international community of around 1,000 members widens the search for rare expertise. We assemble a dedicated team and project manager for your task.',
                        ],
                    ],
                    [
                        'title' => 'Marketing and communications specialists',
                        'paragraphs' => [
                            'Experts in marketing, creative, analytics and communications help convey the value of a product, find its audience and build engagement with it. We combine strategy, personalised content, promotion and response analysis.',
                            'You can commission a single communications task or end-to-end support for a product launch. We define the scope of work and performance metrics based on the audience, project stage and budget.',
                        ],
                    ],
                    [
                        'title' => 'Our own products',
                        'paragraphs' => [
                            'We develop the GenBook, GenBox, GenCube and GenBlock hardware and the GenClaw, GenSec AI, GenSpace and GenRouter software solutions. Our own products provide a foundation for recurring tasks and can be configured for specific work scenarios.',
                            'You can choose a standalone product, order the configuration you need or include it in an end-to-end project. Features, available configuration and deployment options are determined when the solution is selected.',
                        ],
                    ],
                    [
                        'title' => 'Supply and partner resources',
                        'paragraphs' => [
                            'Warehouses in China and Russia, logistics and direct relationships with manufacturers and component suppliers help us run hardware projects. Professional partnerships widen access to engineering solutions, industry knowledge and resources.',
                            'For the client, this means more options for configuration and delivery. Genla aligns supplies with the rest of the work, taking into account timelines, compatibility and future maintenance terms.',
                        ],
                    ],
                ],
            ],
            [
                'title' => 'What you can get through the platform',
                'layout' => 'cards',
                'cols' => 2,
                'items' => [
                    [
                        'title' => 'A ready-made product',
                        'paragraphs' => [
                            'A suitable software solution or service for a specific task: working with models, setting up a digital workspace, automation or security. We will help you choose the features, configure access and get started.',
                        ],
                    ],
                    [
                        'title' => 'Hardware and computing resources',
                        'paragraphs' => [
                            'A workstation, server, computing system or resources in our data centre. Depending on the task, we offer purchase, rental or capacity as a service. We will select the configuration and plan for its future expansion.',
                        ],
                    ],
                    [
                        'title' => 'An individual service',
                        'paragraphs' => [
                            'Consulting, research, development, integration, infrastructure setup, security assessment, marketing or technical support. You can bring in the expertise you need for a limited stage and keep your existing project team.',
                        ],
                    ],
                    [
                        'title' => 'An end-to-end project',
                        'paragraphs' => [
                            'A coherent solution in which software, AI, hardware, data and business processes work together. Genla takes responsibility for the overall architecture, coordination of participants, implementation and verification of the result.',
                        ],
                    ],
                ],
                'footer' => 'You can start with the scope you need right now. The next stages depend on your goals and the results achieved.',
            ],
            [
                'title' => 'How we find the best terms',
                'paragraphs' => [
                    'Our goal is to offer the most cost-effective way of delivering the solution for the client, taking into account quality, timelines, security and future costs. That is why we look at the entire lifecycle of the solution: supply or development, implementation, operation and possible upgrades.',
                    'Our own assembly workshop, warehouse capacity and direct supplier relationships help us manage component sourcing and hardware preparation. Our own data centre offers a choice between buying infrastructure and using resources on demand. Ready-made products reduce repeated development, and the horizontal organisation of teams lets us bring in specialists at the stages where they are needed.',
                    'You discuss your task directly with the relevant specialists. Genla provides unified project management, discloses the scope of work and resources, and agrees the budget before each stage begins.',
                    'If improving an existing solution or changing a process is enough to reach the goal, we will recommend that option. Any new investment must bring clear value to the client.',
                ],
            ],
            [
                'title' => 'Capabilities for your needs',
                'layout' => 'audiences',
                'cols' => 2,
                'items' => [
                    [
                        'title' => 'Company employee or independent professional',
                        'paragraphs' => [
                            'You can get a consultation, a configured workstation, access to models and computing power, a digital assistant or automation of a specific operation. We will help you choose tools for your profession, learn to use them and check their output.',
                            'This lets you cut routine work, improve quality and take on more complex tasks. When corporate information is involved, we follow your organisation\'s rules and respect your level of authority.',
                        ],
                    ],
                    [
                        'title' => 'Sole proprietor or solopreneur',
                        'paragraphs' => [
                            'You get access to developers, engineers, marketing and infrastructure specialists in the amount you need. You can start with an individual service, a ready-made product, hardware rental or automation of client communication.',
                            'As your business grows, we help you develop the solution, add new features and scale resources. You keep a single point of contact at Genla and a clear breakdown of costs.',
                        ],
                    ],
                    [
                        'title' => 'Startup or project team',
                        'paragraphs' => [
                            'You can test a hypothesis with a research group, build a prototype with developers, get infrastructure for a pilot and bring in specialists to reach your audience. For hardware products, engineering design, component sourcing and assembly are available.',
                            'Together we define the first useful version, the validation criteria and the sequence of investments. After the pilot, we help prepare the product and infrastructure for further growth.',
                        ],
                    ],
                    [
                        'title' => 'Executive or representative of a large organisation',
                        'paragraphs' => [
                            'You get access to the platform\'s assembly, warehouse and computing resources and professional teams for individual tasks or comprehensive modernisation. Genla can supply hardware, integrate AI with existing systems, build a corporate environment and organise ongoing support.',
                            'We agree on the architecture, stages, responsibilities and acceptance criteria. We take into account requirements for data, access, business continuity and the long-term development of your infrastructure.',
                        ],
                    ],
                ],
            ],
            [
                'title' => 'The client journey',
                'layout' => 'steps',
                'items' => [
                    [
                        'title' => 'Understanding the task',
                        'paragraphs' => [
                            'We discuss your goals, current situation, available resources and constraints. You can start with a consultation and a free basic audit. The outcome of this stage is a clear view of priorities and a useful next step.',
                        ],
                    ],
                    [
                        'title' => 'Choosing the solution',
                        'paragraphs' => [
                            'We determine whether a ready-made product or an individual service is enough, which existing resources can be used and where development is required. For complex tasks, we agree on an in-depth study separately. You receive implementation options with their advantages and limitations.',
                        ],
                    ],
                    [
                        'title' => 'Plan and terms',
                        'paragraphs' => [
                            'We prepare a proposal covering the scope of work, the hardware or resource configuration, the team, timelines, cost and acceptance criteria. We define data requirements, rules of engagement and support terms. You get a clear plan with named owners for each part.',
                        ],
                    ],
                    [
                        'title' => 'Validation and delivery',
                        'paragraphs' => [
                            'If the solution requires testing a hypothesis, we start with a prototype or pilot. Once approved, we carry out development, assembly, configuration or integration. We present results stage by stage, test them against real work scenarios and incorporate feedback.',
                        ],
                    ],
                    [
                        'title' => 'Handover',
                        'paragraphs' => [
                            'We conduct the agreed testing and acceptance, then hand over the hardware or solution along with the necessary access and documentation. We help users master the work scenarios. We define how requests are handled and who is responsible for ongoing operation.',
                        ],
                    ],
                    [
                        'title' => 'Support',
                        'paragraphs' => [
                            'Within the agreed scope, we provide support, diagnostics, updates and system health monitoring. We analyse emerging issues and actual workload. For critical services, we separately define availability and response time requirements.',
                        ],
                    ],
                    [
                        'title' => 'Long-term development',
                        'paragraphs' => [
                            'We revisit the project goals, assess the impact achieved and discuss new needs. We propose the improvements required: additional features, hardware upgrades, infrastructure expansion or the next stage of product development. Every change comes with a rationale, a defined scope and agreed terms.',
                        ],
                    ],
                ],
                'after' => [
                    'Buying a single product or piece of hardware, or ordering a small service, follows a shorter path: selection, agreement on terms, delivery or execution, and acceptance. Ongoing support is chosen as needed.',
                ],
            ],
            [
                'title' => 'Long-term relationships',
                'paragraphs' => [
                    'We build relationships with clients that last for years. To do this, we retain the context of each task, respect the architectural decisions already made and help develop what has been built step by step.',
                    'After implementation, it is important to understand how the solution works in practice: whether employees find it convenient, whether it justifies its costs, whether performance is sufficient and whether quality holds up. With long-term support, we agree to review these questions regularly and define the next steps together.',
                    'A development plan may include improving user scenarios, new integrations, stronger security, model updates, more computing capacity or support for entering a new market. Priorities are set by the value to the client and the readiness of their team for change.',
                    'We support the client\'s independence: we hand over agreed deliverables and documentation, explain how the solution works, and discuss intellectual property rights and maintenance terms in advance. This approach builds cooperation on trust and on the clear value of our work.',
                ],
            ],
            [
                'title' => 'An international platform with Russian roots',
                'paragraphs' => [
                    'Genla is growing as an international company and platform with Russian roots. Our assembly workshop and warehouse in China and our hardware warehouse and engineering expertise in Russia are complemented by professional ties in Belarus, the Netherlands, India and other countries.',
                    'We keep expanding our network of partners and bringing in new teams and research expertise. Some of the professional relationships between our key members go back more than ten years. This experience helps us find specialists who know how to work together and take responsibility for their part of the result.',
                    'We aim to work at the forefront of technology: we study new approaches, test their applicability and turn useful developments into accessible products and services. Clients get the opportunity to grow their solutions together with a growing platform.',
                    'We organise international cooperation in line with each project\'s requirements. The team composition, data location and system access are agreed with the client. Confidential information remains under the established controls.',
                ],
            ],
            [
                'title' => 'Frequently asked questions',
                'layout' => 'faq',
                'items' => [
                    [
                        'q' => 'Can I buy only hardware or order a single service?',
                        'a' => 'Yes. Through Genla you can buy a standalone product or hardware, rent resources, or order consulting, development, configuration, marketing or support. An end-to-end project is only needed when your task calls for one.',
                    ],
                    [
                        'q' => 'Where are Genla\'s assembly workshop and warehouses located?',
                        'a' => 'Our own assembly workshop and warehouse are in China. In Russia, we have a hardware warehouse and a design bureau. We select components and carry out assembly, configuration and testing. The configuration and scope of preparation are agreed to fit the client\'s task.',
                    ],
                    [
                        'q' => 'Where can our systems run?',
                        'a' => 'In Genla\'s own data centre, on the client\'s hardware or in agreed partner infrastructure. You can choose dedicated servers, virtual resources, a corporate cloud or a combination of environments. The choice depends on workload, budget and data requirements.',
                    ],
                    [
                        'q' => 'Can you work with our IT team and existing contractors?',
                        'a' => 'Yes. We can provide a specific area of expertise or take on an agreed scope of integration. Before work begins, we define roles, boundaries of responsibility and how we will work together, so that every participant understands their tasks.',
                    ],
                    [
                        'q' => 'What makes your terms more cost-effective?',
                        'a' => 'We use our own assembly workshop, warehouses and computing infrastructure, ready-made products, direct interaction with specialists and on-demand involvement of experts. We compare options taking into account implementation and operating costs. Specific terms depend on the scope of the task and the requirements for the result.',
                    ],
                    [
                        'q' => 'What happens after implementation is complete?',
                        'a' => 'We hand over the result and the necessary materials and help you start operating the solution. By agreement, we provide support and further development: we analyse user experience, fix issues, update components and plan improvements. The support format is chosen to fit your task.',
                    ],
                    [
                        'q' => 'How can we tell a solution is right before making large investments?',
                        'a' => 'For tasks with significant uncertainty, we offer research, a prototype or a pilot. We define the testing conditions and value criteria in advance. The results help you make an informed decision about the next stage.',
                    ],
                ],
            ],
            [
                'title' => 'Every project contributes to our mission',
                'paragraphs' => [
                    'Genla\'s mission is to combine human potential with advanced technology to achieve extraordinary results in life, career and business.',
                    'Every project we take responsibility for helps turn this mission into practical change: expanding human capabilities, making organisations more effective, strengthening technological sovereignty and laying the foundation for the lasting leadership of our partners.',
                    'Long-term cooperation lets us see these changes, build on the results achieved and discover new opportunities together.',
                ],
            ],
        ],
        'closing' => [
            'title' => 'Let\'s discuss your task',
            'text' => 'Tell us what you need right now: hardware, computing resources, a ready-made product, an individual service or an end-to-end solution. We will help you choose the right format and define the first step.',
        ],
    ],

    'cases' => [
        'seo_title' => 'Genla case studies — AI, marketing, audits and systems integration',
        'seo_description' => 'Genla projects: websites and promotion, digital employees, model fine-tuning, audits, hardware and corporate clouds. Challenges, solutions, results and labs.',
        'hero' => [
            'title' => 'Case studies',
            'subtitle' => 'How the platform\'s capabilities turn into results',
            'paragraphs' => [
                'We help employees, entrepreneurs and organisations solve specific problems: attract customers, reduce routine work, develop products, preserve knowledge and build their own infrastructure.',
                'This page brings together Genla projects and joint work with the platform\'s specialist teams. Each case shows the challenge, the approach and the result achieved. In line with our confidentiality agreements, we do not disclose the names of clients or contractors, or any identifying details.',
                'Figures are based on project data and client assessments. Worked examples are marked separately; when choosing a solution, we take into account the starting situation and the conditions in which it will be used.',
            ],
        ],
        'labels' => [
            'industry' => 'Industry',
            'labs' => 'Project labs',
            'role' => 'Genla’s role',
            'task' => 'Challenge',
            'solution' => 'Solution',
            'result' => 'Result',
            'estimate' => 'Worked example',
            'more' => 'Case details',
            'less' => 'Collapse',
            'cta' => 'Discuss a similar project',
        ],
        'items' => [
            [
                'num' => '01',
                'title' => 'Twenty websites for a group of education projects',
                'industry' => 'Preparation for the Unified State Exam (EGE)',
                'labs' => 'GenPromo, GenReview',
                'task' => 'Build a consistent online presence for a group of companies so that prospective students and their parents could find suitable exam preparation services through different ways of searching for information.',
                'solution' => 'We developed 20 websites using our own SEO and GEO presence methodology. The approach combines search engine optimisation with preparing information so that it can be found and used in generative search answers. The content is built around the educational offers and the audience\'s questions.',
                'result' => [
                    '**20 websites for a single group of education projects.** Each website presents EGE preparation services and creates a separate point of first contact with the offer.',
                    'The methodology combines SEO and GEO: presence in search results and preparation of information for generative search answers. This created a foundation for further promotion and for expanding content across the preparation subjects.',
                ],
                'metrics' => [
                    '**20 websites for a single group of education projects.**',
                ],
            ],
            [
                'num' => '02',
                'title' => 'A custom language model for an education project',
                'industry' => 'Education, intelligent services',
                'labs' => 'GenType, GenCloud',
                'task' => 'Improve the performance of an education project\'s agents, preserve their distinctive behaviour and speed up request processing. At the same time, the client needed to simplify the structure of the knowledge base and keep control over the model.',
                'solution' => 'We fine-tuned a language model on Genla\'s own hardware, taking into account the project\'s professional specifics. The work focused on authentic agent behaviour, answer quality and consistent use of the knowledge base. The resulting model was deployed on the client\'s hardware.',
                'result' => [
                    '**The fine-tuned model is deployed on the client\'s hardware.** The agents\' answers improved, they work faster, and the knowledge base is simpler to organise.',
                    'The education project gained its own foundation for developing intelligent services while keeping their individual character. The key evaluation parameters are answer quality on benchmark tasks, request processing time and knowledge base size. The numerical results of these measurements are not disclosed in the public case study.',
                ],
                'metrics' => [
                    '**The fine-tuned model is deployed on the client\'s hardware.**',
                ],
            ],
            [
                'num' => '03',
                'title' => 'Personal digital employees for a management company',
                'industry' => 'Organisational management and everyday work processes',
                'labs' => 'GenClaw',
                'task' => 'Make employees more effective and give each of them a personal assistant that is useful both at work and for everyday tasks outside it.',
                'solution' => 'We rolled out personal GenClaw agents to all employees of the management company. The company paid for its employees\' access to the solution. The agents were configured for each user\'s individual tasks so that digital assistance became part of their daily routine.',
                'result' => [
                    '**2× productivity growth, according to the client.**',
                    '**100% of employees** of the management company received personal GenClaw agents paid for by the employer.',
                    'Employees began organising their work more effectively and using their assistants outside the workplace. The client noted higher motivation and loyalty, as well as revenue growth alongside the rollout.',
                ],
                'metrics' => [
                    '**2× productivity growth, according to the client.**',
                    '**100% of employees** of the management company received personal GenClaw agents paid for by the employer.',
                ],
            ],
            [
                'num' => '04',
                'title' => 'An audit that helped avoid unjustified spending',
                'industry' => 'Food industry',
                'labs' => 'GenReview',
                'task' => 'Review an AI implementation proposal worth RUB 1 million and determine whether its scope matched the company\'s actual needs.',
                'solution' => 'We analysed the proposed solution, its components and the required scope of work. The audit showed that the main need could be met with a freely available component and a service costing about RUB 1,000 per month. We also looked separately at which connection and configuration steps the client actually needed.',
                'result' => [
                    '**RUB 1 million** — the cost of the proposal the client declined after the audit.',
                    '**About RUB 1,000 per month** — the subscription to a service suitable for the main task.',
                    '**About RUB 12,000 per year** — the estimated cost of this subscription at the stated monthly price.',
                    'The company gained a more cost-effective way to solve the problem and kept its budget for justified changes. The subscription estimate does not include connection, configuration and support; these are separate components of the solution\'s cost.',
                ],
                'metrics' => [
                    '**RUB 1 million** — the cost of the proposal the client declined after the audit.',
                    '**About RUB 1,000 per month** — the subscription to a service suitable for the main task.',
                    '**About RUB 12,000 per year** — the estimated cost of this subscription at the stated monthly price.',
                ],
            ],
            [
                'num' => '05',
                'title' => 'A corporate cloud with lower launch and ownership costs',
                'industry' => 'Corporate infrastructure',
                'labs' => 'GenReview, GenFleet, GenCloud',
                'task' => 'Help a subsidiary of a large corporation choose a reliable contractor, purchase hardware and launch its own corporate cloud on economically sound terms.',
                'solution' => 'We carried out an audit and helped shape the approach to delivering a multi-component project. We selected a specialist contractor, with whom the client signed a contract. The project covered hardware procurement and the launch of a corporate cloud, with freedom to choose suppliers and to develop the infrastructure independently in the future.',
                'result' => [
                    '**30% lower start-up costs** compared with the option originally considered.',
                    '**50% lower estimated cost of ownership**, according to the project estimate.',
                    'The client gained a working corporate cloud environment and a reliable contractor to deliver it.',
                    'Genla\'s role: the audit, selecting the solution and connecting the client with a specialist team to carry out the project.',
                ],
                'metrics' => [
                    '**30% lower start-up costs** compared with the option originally considered.',
                    '**50% lower estimated cost of ownership**, according to the project estimate.',
                ],
            ],
            [
                'num' => '06',
                'title' => 'A corporate knowledge base for a research organisation',
                'industry' => 'Science and research',
                'labs' => 'GenType, GenCloud',
                'task' => 'Make a large body of specialised materials searchable and usable for researchers while keeping answers linked to the original sources.',
                'solution' => 'We set up a digital knowledge base and enabled a language model to work with specialised terminology. We prepared the infrastructure for searching the materials and for working collaboratively with the accumulated expertise.',
                'result' => [
                    '**80 volumes, more than 30,000 pages** — the size of the processed knowledge base.',
                    '**More than 50,000 pages of answers** with references to original sources have been generated through use of the system.',
                    '**More than 300 researchers** — the community around the digital knowledge base.',
                    'Researchers gained a single tool for searching and working with specialised materials. The scale of use is reflected in the volume of knowledge processed, the answers produced and the number of participants.',
                ],
                'metrics' => [
                    '**80 volumes, more than 30,000 pages** — the size of the processed knowledge base.',
                    '**More than 50,000 pages of answers** with references to original sources have been generated through use of the system.',
                    '**More than 300 researchers** — the community around the digital knowledge base.',
                ],
            ],
            [
                'num' => '07',
                'title' => 'Automating initial legal consultations',
                'industry' => 'Legal services',
                'labs' => 'GenType, GenClaw',
                'task' => 'Organise the initial handling of enquiries and help specialists work with professional information in their own digital environment.',
                'solution' => 'We created a knowledge base and an intelligent assistant for routine questions. Complex enquiries are designed to be passed on to a specialist. The solution combined access to professional materials with the first contact with a prospective client.',
                'result' => [
                    '**Up to 80–85%** — the stated reduction in operating costs for software.',
                    '**On average 2 times faster** completion of analytical processes.',
                    '**Up to 30–40 hours per month per specialist** — the stated time savings when working with information.',
                    '**24/7** — initial enquiries handled by the intelligent assistant.',
                ],
                'metrics' => [
                    '**Up to 80–85%** — the stated reduction in operating costs for software.',
                    '**On average 2 times faster** completion of analytical processes.',
                    '**Up to 30–40 hours per month per specialist** — the stated time savings when working with information.',
                    '**24/7** — initial enquiries handled by the intelligent assistant.',
                ],
                'estimate' => '**Worked example for a team of 20 specialists.** With an initial software price of RUB 10,000 per person per month, costs amount to RUB 2.4 million per year. Cutting this item by 80–85% corresponds to savings of **RUB 1.92–2.04 million per year**. This illustrates the calculation and is not this client\'s actual budget; the costs of implementing and operating the new system must be taken into account in the overall project economics.',
            ],
            [
                'num' => '08',
                'title' => 'A digital environment for an education community',
                'industry' => 'EdTech, professional communities',
                'labs' => 'GenPromo, GenClaw',
                'task' => 'Grow a community of students and alumni, help members find useful activities and keep them connected to the education project.',
                'solution' => 'We combined the community\'s digital tools with expert meetings and professional activities. An intelligent assistant helped match members with formats of participation and supported interaction with them.',
                'result' => [
                    '**Up to 34%** — growth in LTV, the customer\'s value over the entire relationship.',
                    '**Up to 28%** — reduction in CAC, the cost of acquiring a customer.',
                    '**Up to 14.5%** — conversion of registered AI agent users into paying students.',
                    'According to project data, the community became a channel for attracting an audience and generating repeat sales. The digital tools worked together with expert meetings and regular interaction with members.',
                ],
                'metrics' => [
                    '**Up to 34%** — growth in LTV, the customer\'s value over the entire relationship.',
                    '**Up to 28%** — reduction in CAC, the cost of acquiring a customer.',
                    '**Up to 14.5%** — conversion of registered AI agent users into paying students.',
                ],
            ],
            [
                'num' => '09',
                'title' => 'Digital support for knowledge work in bioregulation',
                'industry' => 'Bioregulation, specialised knowledge',
                'labs' => 'GenType, GenClaw',
                'task' => 'Organise work with a specialised knowledge base, make it easier for the team to access materials and support the growth of the partner network.',
                'solution' => 'We prepared digital assistants for working with professional information, initial enquiries and partner materials. We put the accumulated knowledge to use in consulting work and in onboarding new members of the network.',
                'result' => [
                    '**Up to 24%** — sales growth in the partner network.',
                    '**Up to 2.5 times faster** onboarding of new partners.',
                    '**Up to 35%** — reduction in support costs.',
                    '**Up to 80%** of routine initial requests are handled by AI assistants.',
                    'The figures relate to work organisation, support and the project\'s commercial results. The digital knowledge base became an everyday working tool for specialists and partners.',
                ],
                'metrics' => [
                    '**Up to 24%** — sales growth in the partner network.',
                    '**Up to 2.5 times faster** onboarding of new partners.',
                    '**Up to 35%** — reduction in support costs.',
                    '**Up to 80%** of routine initial requests are handled by AI assistants.',
                ],
            ],
            [
                'num' => '10',
                'title' => 'An AI strategy for an international partner network',
                'industry' => 'International business and partner sales',
                'labs' => 'GenReview, GenPromo, GenCloud',
                'task' => 'Determine how to use artificial intelligence in the work of an international organisation and in supporting its partners, and align the development priorities for digital services.',
                'solution' => 'We carried out strategic work and prepared architectural proposals and a roadmap for developing AI tools. We covered partner network support, knowledge management and content preparation.',
                'result' => [
                    '**More than RUB 10 million** — reduction in the IT integration budget at the design and architecture planning stage.',
                    '**Up to 42%** — reduction in content preparation costs.',
                    '**Up to 18%** — growth in the partner satisfaction index.',
                    '**Up to 30%** — reduction in time to market for new products.',
                    'According to project data, the strategic work and the development of intelligent tools helped align digital initiatives, reduce costs and speed up support for the partner network.',
                ],
                'metrics' => [
                    '**More than RUB 10 million** — reduction in the IT integration budget at the design and architecture planning stage.',
                    '**Up to 42%** — reduction in content preparation costs.',
                    '**Up to 18%** — growth in the partner satisfaction index.',
                    '**Up to 30%** — reduction in time to market for new products.',
                ],
            ],
            [
                'num' => '11',
                'title' => 'On-premises computing infrastructure for a construction company',
                'industry' => 'Construction and engineering',
                'labs' => 'GenReview, GenFleet, GenCloud',
                'task' => 'Provide the organisation with its own computing resources for working with models and developing internal intelligent tools.',
                'solution' => 'We selected server hardware and prepared an on-premises software environment. We arranged delivery, configuration and technical support terms tailored to the client\'s needs.',
                'result' => [
                    '**Up to 56%** — reduction in GPU infrastructure costs.',
                    '**Up to 14 months** — hardware payback period, according to project calculations.',
                    '**Up to 4 times faster** deployment of new models.',
                    '**Up to 20%** — budget savings on management and design.',
                    'The on-premises computing environment gave the team resources to run and develop models within its own infrastructure. The figures reflect a combination of hardware, software configuration and workflow automation.',
                ],
                'metrics' => [
                    '**Up to 56%** — reduction in GPU infrastructure costs.',
                    '**Up to 14 months** — hardware payback period, according to project calculations.',
                    '**Up to 4 times faster** deployment of new models.',
                    '**Up to 20%** — budget savings on management and design.',
                ],
            ],
            [
                'num' => '12',
                'title' => 'An AI sales assistant for an online store',
                'industry' => 'E-commerce, cosmetics and beauty equipment',
                'labs' => 'GenClaw, GenPromo',
                'task' => 'Help visitors navigate the store\'s range and find a suitable product category through an ordinary conversation.',
                'solution' => 'We created an AI sales assistant that knows the catalogue and placed it on the website. Visitors can describe what they need in their own words and get information about the range in a single interface.',
                'result' => [
                    '**The website gained an additional consultation channel.** Product knowledge became available in a conversation; shoppers do not need to know the exact product name to start. The quantitative effect on sales is not stated in the public description.',
                ],
                'metrics' => [
                    '**The website gained an additional consultation channel.**',
                ],
            ],
            [
                'num' => '13',
                'title' => 'Better sales conversations at a renovation company',
                'industry' => 'Renovation and contracting',
                'labs' => 'GenReview, GenPromo',
                'role' => 'Bringing in the client and connecting them with the specialist partner team that carried out the implementation',
                'task' => 'Help managers hold better conversations with customers and move each enquiry on to the next step in the sale.',
                'solution' => 'The partner team introduced AI call analysis and conversation reviews with expert feedback. The analytics were used together with staff training and the manager\'s own work with the team.',
                'result' => [
                    '**4.3 → 8.1 out of 10** — the department\'s quality score over the comparison period in July–August 2026.',
                    '**8 out of 9 criteria** showed improvement.',
                    '**70–75%** — conversion to a booked on-site measurement in certain periods, according to the manager.',
                    'Conversation quality was assessed with analytics, training and the manager\'s work applied together. The advertising budget also changed during this period, so the growth in the number of measurements cannot be attributed entirely to AI.',
                ],
                'metrics' => [
                    '**4.3 → 8.1 out of 10** — the department\'s quality score over the comparison period in July–August 2026.',
                    '**8 out of 9 criteria** showed improvement.',
                    '**70–75%** — conversion to a booked on-site measurement in certain periods, according to the manager.',
                ],
            ],
            [
                'num' => '14',
                'title' => 'Developing consultative sales of building materials',
                'industry' => 'Building materials sales',
                'labs' => 'GenReview, GenPromo',
                'role' => 'Bringing in the client and connecting them with the specialist partner team that carried out the implementation',
                'task' => 'Help managers consult with more confidence, understand the buyer\'s needs and explain the value of the offer.',
                'solution' => 'The partner team introduced call analysis and used its results in training. The manager gained the ability to choose conversations for review and track changes in the department\'s performance.',
                'result' => [
                    '**4.4 → 6.9 out of 10** — the department\'s quality score over the comparison period in June–July 2026.',
                    '**Managers\' sales grew by about 50%** compared with the previous period, according to the manager.',
                    '**2.5 → 6.0 out of 10** — the score for the quality of offer presentation.',
                    'The analytics were used together with training and the manager\'s involvement. Sales were also affected by seasonality.',
                ],
                'metrics' => [
                    '**4.4 → 6.9 out of 10** — the department\'s quality score over the comparison period in June–July 2026.',
                    '**Managers\' sales grew by about 50%** compared with the previous period, according to the manager.',
                    '**2.5 → 6.0 out of 10** — the score for the quality of offer presentation.',
                ],
            ],
            [
                'num' => '15',
                'title' => 'Feedback for receptionists at a veterinary clinic',
                'industry' => 'Veterinary care, customer service',
                'labs' => 'GenReview, GenPromo',
                'role' => 'Bringing in the client and connecting them with the specialist partner team that carried out the implementation',
                'task' => 'Improve the handling of phone enquiries and appointment booking, and make feedback to receptionists faster.',
                'solution' => 'The partner team set up AI conversation analysis based on the clinic\'s criteria. The results were used to give feedback to staff and to review cases with the manager.',
                'result' => [
                    '**By 22%** the booking success rate grew after two months, according to project data.',
                    '**100% of calls** are covered by automated analysis.',
                    '**9.0 → 9.7 out of 10** — the score for booking accuracy.',
                    'The growth in booking success is given in percent, not percentage points. The baseline booking rate and the detailed calculation method are not disclosed in the public description.',
                ],
                'metrics' => [
                    '**By 22%** the booking success rate grew after two months, according to project data.',
                    '**100% of calls** are covered by automated analysis.',
                    '**9.0 → 9.7 out of 10** — the score for booking accuracy.',
                ],
            ],
            [
                'num' => '16',
                'title' => 'Higher order conversion for a delivery service',
                'industry' => 'Water delivery, repeat sales',
                'labs' => 'GenReview, GenPromo',
                'role' => 'Bringing in the client and connecting them with the specialist partner team that carried out the implementation',
                'task' => 'Improve the handling of first-time and repeat enquiries, and identify situations in which a manager misses an order or further contact.',
                'solution' => 'The partner team introduced AI conversation analysis. The manager used the results to select cases, give feedback to staff and regularly review the department\'s work.',
                'result' => [
                    '**Cross-sales volume doubled** in May compared with February 2026, according to the client, without any increase in the advertising budget.',
                    '**61% → 69%** — conversion from enquiry to order: an increase of **8 percentage points** comparing March and April.',
                    '**50% → 72%** — the share of new customers who placed a second order: an increase of **22 percentage points** comparing March and May.',
                    'The changes were observed alongside the introduction of analytics and the manager\'s regular work with the team. The contribution of AI was not measured separately.',
                ],
                'metrics' => [
                    '**Cross-sales volume doubled** in May compared with February 2026, according to the client, without any increase in the advertising budget.',
                    '**61% → 69%** — conversion from enquiry to order: an increase of **8 percentage points** comparing March and April.',
                    '**50% → 72%** — the share of new customers who placed a second order: an increase of **22 percentage points** comparing March and May.',
                ],
            ],
            [
                'num' => '17',
                'title' => 'A digital office for an expert-led project',
                'industry' => 'Expert, educational and media projects',
                'labs' => 'GenClaw, GenPromo',
                'task' => 'Bring an expert\'s materials, programmes and areas of work together in a clear digital space and make the first contact with visitors easier.',
                'solution' => 'We created a digital office with an AI assistant. It helps visitors find their way around the materials, choose the area they are interested in and pass their question on to the team.',
                'result' => [
                    '**A single point of first contact with the expert and their projects.** Visitors can now find materials and reach the team through a convenient digital interface. Conversion and time-saving figures are not stated in the public description.',
                ],
                'metrics' => [
                    '**A single point of first contact with the expert and their projects.**',
                ],
            ],
            [
                'num' => '18',
                'title' => 'Up to twenty warm leads per hour at an event',
                'industry' => 'Fintech, event marketing',
                'labs' => 'GenPromo',
                'task' => 'Turn the company\'s presence at an industry event into a stream of interested contacts and subsequent sales.',
                'solution' => 'We organised joint work by a photographer and a promoter using AI. Personalised photo content became a reason to start a conversation, and talking with the promoter helped move on to the guest\'s interests and the company\'s offer. The scenario combined creating content for the attendee, initial communication and following up after the event.',
                'result' => [
                    '**Up to 20 warm leads per hour.** The company gained an inflow of potential customers interested in further conversations.',
                    'According to the project estimate, the return from the first deal was **10× the investment in the promotion**. The customer\'s further value over the entire relationship (LTV) was not included in this estimate.',
                ],
                'metrics' => [
                    '**Up to 20 warm leads per hour.**',
                    'According to the project estimate, the return from the first deal was **10× the investment in the promotion**',
                ],
            ],
        ],
        'sections' => [
            [
                'title' => 'Which experience may be useful to you',
                'layout' => 'audiences',
                'items' => [
                    [
                        'title' => 'Company employee or independent professional',
                        'paragraphs' => [
                            'Personal agents, a digital office and work with a knowledge base help reduce repetitive tasks, find information faster and organise your own work. You can start with a single task that regularly takes up your time.',
                        ],
                    ],
                    [
                        'title' => 'Sole proprietor or solopreneur',
                        'paragraphs' => [
                            'Our experience in promotion, customer acquisition and automating initial enquiries can be applied to your business. An audit helps determine which tools you need now and which costs you can avoid.',
                        ],
                    ],
                    [
                        'title' => 'Startup or project team',
                        'paragraphs' => [
                            'Cases on building websites, fine-tuning a model and setting up infrastructure show different ways to develop a product. We will help you choose a suitable first stage and the criteria for assessing its usefulness.',
                        ],
                    ],
                    [
                        'title' => 'Executive or representative of a large organisation',
                        'paragraphs' => [
                            'Projects involving a corporate cloud, the rollout of personal agents and systematic work with data help assess the potential for change in your organisation. We will consider your scale, existing systems, security requirements and the terms of ongoing support.',
                        ],
                    ],
                ],
            ],
            [
                'title' => 'Frequently asked questions',
                'layout' => 'faq',
                'items' => [
                    [
                        'q' => 'Why are company names not given in the case studies?',
                        'a' => 'We respect our confidentiality agreements with clients and project participants. Publicly, we show the challenge, the approach and the results that may be disclosed. Additional materials are provided individually within the agreed terms.',
                    ],
                    [
                        'q' => 'Who carries out the platform\'s projects?',
                        'a' => 'The labs bring together specialists and specialist teams in each area of work. Several labs may take part in a project. In joint case studies, Genla\'s role is stated separately, including bringing in the client and connecting them with a suitable team.',
                    ],
                    [
                        'q' => 'Can I get the same result?',
                        'a' => 'The figures relate to specific projects. For your task, we first assess the starting situation and then choose the result criteria and the method of verification. The effect depends on the data, processes, team and the conditions in which the solution is used.',
                    ],
                    [
                        'q' => 'Can I order just one part of a solution?',
                        'a' => 'Yes. It can be an audit, a website, setting up a digital employee, fine-tuning a model, supplying hardware or another specific piece of work. We define the scope of Genla\'s involvement based on your task.',
                    ],
                ],
            ],
        ],
        'closing' => [
            'title' => 'Let\'s discuss your task',
            'text' => 'Tell us what you want to improve in your work, project or organisation. We will find relevant experience, determine a suitable format for working together and the first useful step.',
        ],
    ],

    'become_partner' => [
        'seo_title' => 'Become a Genla partner: specialists, products and a regional network',
        'seo_description' => 'Partnering with Genla: specialists, developers of boxed and SaaS products, ambassadors and franchisees. Leave your contact details for an introductory call and consultation.',
        'hero' => [
            'title' => 'Become a partner',
            'subtitle' => 'Your independence. The reach of an international platform.',
            'paragraphs' => [
                'Genla brings together specialists, product developers, entrepreneurs and regional teams. Here you can earn with your expertise, distribute ready-made solutions, help clients or grow the platform in your own territory.',
                'We are building a horizontal environment for collaboration: everyone focuses on what they do best, while shared products, infrastructure and support make it possible to take on larger challenges.',
                'People are at the core of the platform. They set goals, create solutions, assess quality and take responsibility for results. Artificial intelligence extends their capabilities and helps them apply professional experience to greater effect.',
                'The Genla platform economy pools resources for sales, development, computing and ongoing support. Participants bring in the skills a specific task requires, share the organisational workload and draw on collective experience. This helps reduce repeated costs, develop long-term projects and devote more attention to their own strengths.',
                'Choose the role you are interested in and leave your contact details. We will message you in your preferred messenger, agree on a time and send you a meeting link. We will start by getting to know each other and discussing opportunities for cooperation.',
            ],
        ],
        'roles_title' => 'Choose a role',
        'roles' => [
            ['key' => 'specialist', 'title' => 'Specialist', 'text' => 'Apply your expertise in Genla projects and take part in building and developing our products, including GenClaw. At the meeting we will discuss your strengths, suitable tasks and terms of cooperation.'],
            ['key' => 'product', 'title' => 'Product partner', 'text' => 'Connect a ready-made boxed product for on-premises installation or a SaaS product that can be deployed on Genla servers. Retain authorship and earn income from sales or use of your solution through the platform.'],
            ['key' => 'ambassador', 'title' => 'Platform ambassador', 'text' => 'Build client relationships, offer Genla products and services, and earn rewards for paid deals. Expand your own opportunities together with the platform.'],
            ['key' => 'franchise', 'title' => 'Platform franchisee', 'text' => 'Build a regional team, bring ambassadors together and grow the Genla business in your city. This format is open to sole proprietors and LLCs after at least three months of successful cooperation as an ambassador.'],
        ],
        'role_cta' => 'Choose a role',
        'sections' => [
            [
                'title' => 'Specialist',
                'layout' => 'cards',
                'cols' => 2,
                'items' => [
                    [
                        'title' => 'The work of the future, built around your expertise',
                        'paragraphs' => [
                            'We invite independent specialists, self-employed professionals and solopreneurs. The platform needs researchers, engineers, programmers, managers, salespeople, marketers, organisers and other professionals who can take responsibility for a specific result.',
                            'Leave your contact details and specify your field. At the interview we will discuss your specialisation, tasks that interest you, your rates and a workload that suits you. Once the terms are agreed, we connect you to the cooperation system and match you with suitable projects.',
                        ],
                    ],
                    [
                        'title' => 'Freedom without a vertical chain of command',
                        'paragraphs' => [
                            'You decide which tasks to accept, agree on your workload and organise your own working time. Each project has a coordinator, a shared goal, deadlines and quality criteria. Responsibility is distributed among participants according to their roles.',
                        ],
                    ],
                    [
                        'title' => 'A more stable professional practice',
                        'paragraphs' => [
                            'The platform helps you find suitable projects and build long-term relationships with clients. You can take part in individual stages, support solutions after launch or work in a permanent project team. Workload depends on demand, skills and the availability agreed with the specialist.',
                        ],
                    ],
                    [
                        'title' => 'Legal and organisational support',
                        'paragraphs' => [
                            'Work is formalised through clear agreements: tasks, cost, deadlines, acceptance criteria, payment terms, confidentiality and rights to the results. Genla helps organise interaction with the client, document changes and resolve disputes within the agreed obligations.',
                        ],
                    ],
                    [
                        'title' => 'Growth among professionals',
                        'paragraphs' => [
                            'You get access to knowledge sharing, task reviews, training on the platform\'s products and projects with specialists from other disciplines. You can deepen your specialisation, master related tasks, and grow as a project manager or practice lead.',
                        ],
                    ],
                    [
                        'title' => 'Bonuses, events and networking',
                        'paragraphs' => [
                            'The participation programme includes bonuses, gifts and free attendance at industry events by invitation from the platform and its partners. Opportunities depend on the participant\'s activity, contribution and available invitations. We help specialists attend major events in their industry, make new connections and present the results of their work.',
                        ],
                    ],
                    [
                        'title' => 'Build and develop GenClaw',
                        'paragraphs' => [
                            'GenClaw grows through the work of people: developers, engineers, researchers, industry experts, and quality and security specialists. Team members design agent behaviour, create skills and integrations, review results, deploy solutions and improve them based on real user tasks.',
                            'We value professional judgement, initiative and responsibility. Specialists are rewarded for their contribution to building, deploying and developing the product on agreed terms.',
                        ],
                    ],
                    [
                        'title' => 'Learn to build your own AI agents',
                        'paragraphs' => [
                            'We are developing a separate line of paid hands-on training for specialists, entrepreneurs and teams. We help you master building, configuring and using your own agents: from defining the task and connecting tools to quality checks, secure data handling and further development of the solution.',
                            'The goal of the training is to give people more independence and opportunities in their work. The programme, format and cost are agreed before classes begin. Training is optional; for participation in partner projects we assess skills and the appropriate format of cooperation.',
                        ],
                    ],
                ],
            ],
            [
                'title' => 'Product partner',
                'layout' => 'cards',
                'cols' => 2,
                'items' => [
                    [
                        'title' => 'A ready-made product, new distribution opportunities',
                        'paragraphs' => [
                            'We invite developers and rights holders of ready-made solutions that can be connected to the Genla ecosystem. Two formats suit this role:',
                            '**Boxed product**: a ready-made solution with delivery, documentation and the option of on-premises installation, either on the client\'s hardware or in Genla infrastructure.',
                            '**SaaS product on Genla servers**: a software service that can be deployed in our infrastructure and provided to users by subscription or another agreed model.',
                            'An essential condition is that the product can actually be deployed. For SaaS, hosting on Genla servers is part of the cooperation model. External dependencies and required integrations are reviewed during the technical assessment.',
                        ],
                    ],
                    [
                        'title' => 'The developer keeps their name',
                        'paragraphs' => [
                            'The product listing shows the product name and its developer. Rights to the existing solution remain with the rights holder under the agreed licence. Genla\'s authority to host, sell, provide access to and support the product is defined separately.',
                            'An application can be submitted by the developer, the rights holder or their authorised representative. At the first meeting we will discuss the product and the hosting terms. Details of the developer, the rights holder and the contracting party are confirmed when the cooperation is prepared.',
                        ],
                    ],
                    [
                        'title' => 'What the platform offers',
                        'paragraphs' => [
                            'Genla helps present the product to clients, organise demonstrations, identify use cases and involve the partner network in sales. For agreed placements we provide computing infrastructure, engineering support and collaboration with regional teams.',
                            'A ready-made product can be sold on its own or used in complex projects. Opportunities for audience reach, integrations and support grow together with the ecosystem.',
                        ],
                    ],
                    [
                        'title' => 'How income is generated',
                        'paragraphs' => [
                            'Options include licence sales, subscriptions, usage-based payments or separate implementation fees. Before connecting the product, we agree on prices, revenue sharing, hosting costs, support obligations and payout procedures. Commercial terms are discussed individually for each product.',
                        ],
                    ],
                    [
                        'title' => 'How we connect a solution',
                        'paragraphs' => [
                            'We get to know the developer, hold a demonstration and check the product\'s readiness for deployment. We then agree on licensing, hosting, support and sales terms. After the technical review and formalisation of the cooperation, we prepare a listing that names the developer and connect the product to the platform\'s available channels.',
                        ],
                    ],
                ],
            ],
            [
                'title' => 'Platform ambassador',
                'layout' => 'cards',
                'cols' => 2,
                'items' => [
                    [
                        'title' => 'Grow client relationships with Genla behind you',
                        'paragraphs' => [
                            'An ambassador connects client needs with the platform\'s capabilities. You can offer clients research, consulting, development, hands-on training, marketing, hardware, cloud resources or a service subscription, backed by a specialist team.',
                            'The format suits individuals, self-employed professionals, sole proprietors and legal entities. It is especially useful for those who already work in a related industry, understand client needs and want to broaden their offering, reach and audience loyalty.',
                            'You keep your relationships with your clients and can grow your own business. Genla helps assess the task, select specialists, prepare a proposal and organise delivery of the agreed work.',
                        ],
                    ],
                ],
            ],
            [
                'title' => 'Clear terms for each line of business',
                'paragraphs' => [
                    'Before work with a client begins, we agree on how your involvement is recorded and what the reward is paid for. Services, hardware, subscriptions and infrastructure each have their own terms.',
                ],
                'layout' => 'table',
                'table' => [
                    'head' => ['Line of business', 'What the reward is paid for'],
                    'rows' => [
                        ['Audit, consulting, development, integration, marketing', 'Paid work or agreed stages of a project brought in by the ambassador.'],
                        ['Hands-on training', 'Paid programmes and classes, if bringing in participants is covered by the agreed terms.'],
                        ['Hardware', 'A paid delivery, taking into account the agreed configuration and deal economics.'],
                        ['Service subscriptions', 'Activation and subsequent paid periods, if recurring rewards are provided for under the terms of that line of business.'],
                        ['Cloud resources, rental and support', 'Paid services and service periods within the agreed programme.'],
                    ],
                ],
                'after' => [
                    'For every deal, the calculation base, rate, amount, triggering event and payout procedure are clear. With staged payments, we take the corresponding portion of the payment into account.',
                ],
            ],
            [
                'title' => 'Payouts as soon as the deal terms are met',
                'paragraphs' => [
                    'We initiate the reward payout as soon as the corresponding payment from the client is received and the agreed conditions are met. For a reward on a paid stage, there is no need to wait for an entire multi-year project to be completed. The transfer procedure, required documents and timelines are set out in the agreement.',
                ],
            ],
            [
                'title' => 'Higher turnover, more opportunities',
                'paragraphs' => [
                    'As paid turnover and the quality of cooperation grow, more privileges become available: personal commercial terms, support for joint marketing, experts joining client meetings, priority resource planning, event invitations and the development of your own team.',
                    'We want ambassadors to build a long-term business based on useful solutions and client trust.',
                ],
            ],
            [
                'title' => 'From ambassador to regional development',
                'paragraphs' => [
                    'You can invite other ambassadors, help them learn the products and develop joint projects. This work lays the foundation for becoming a franchisee.',
                    'After at least three months of effective cooperation, an evaluation of results and the signing of a separate contract, a sole proprietor or LLC can obtain regional status. This opens up the opportunity for regular income from paid deals by representatives assigned to your territory under the terms of the agreement.',
                ],
            ],
            [
                'title' => 'Platform franchisee',
                'layout' => 'cards',
                'cols' => 2,
                'items' => [
                    [
                        'title' => 'Build Genla in your region',
                        'paragraphs' => [
                            'Franchisees form the regional foundation of the platform. They are independent entrepreneurs and companies that develop the market, build teams, support ambassadors and organise projects in their territory.',
                            'The main source of income in this model is management activity and scaling the regional network: developing sales, coordinating participants, maintaining client relationships and increasing the number of valuable projects.',
                        ],
                    ],
                    [
                        'title' => 'Conditions for the transition',
                        'paragraphs' => [
                            'A franchisee can be **only a sole proprietor or an LLC**.',
                            'You need **at least three months of cooperation with Genla as an ambassador**.',
                            'Based on our joint work, we evaluate the results, the quality of client interactions and readiness to develop the territory.',
                            'The status, city or region, authority and commercial terms are set out in a separate franchise agreement.',
                            'If you are just getting to know Genla, you can apply with an interest in regional development. We will start cooperating with you as an ambassador and walk the path to a regional partnership together.',
                        ],
                    ],
                    [
                        'title' => 'Regular income from the regional network',
                        'paragraphs' => [
                            'A franchisee receives an agreed regional reward from the activity of all platform representatives assigned to their territory. Payouts are tied to actual paid deals and to the network development functions performed.',
                            'The model of regular payouts and royalties, the set of deals taken into account, the accrual period and the obligations of the parties are determined individually. This makes it possible to build income on the long-term development of the territory and repeat client business.',
                        ],
                    ],
                    [
                        'title' => 'Products and expertise of an international platform',
                        'paragraphs' => [
                            'You get access to the product line, specialised labs, engineering support, audit methodologies, sales materials and training for your regional team. For complex tasks you can bring in the platform\'s specialists and resources.',
                        ],
                    ],
                    [
                        'title' => 'Additional sources of profit',
                        'paragraphs' => [
                            'We help develop regional services, ongoing support, hardware supply, infrastructure services and industry projects. Together we can create specialised offerings, hold business events and launch new products with local teams.',
                        ],
                    ],
                    [
                        'title' => 'Acceleration and territorial development',
                        'paragraphs' => [
                            'We support the preparation of regional initiatives: we help work out the project, its economics, presentation materials and interaction with development institutions. We assist in finding suitable accelerator programmes and federal and municipal business support measures, preparing to take part in them, and building dialogue with the relevant authorities.',
                            'Decisions on granting state support are made by the relevant organisations under the rules of their programmes. Our role is to help prepare a well-founded project and organise professional work with the available opportunities.',
                        ],
                    ],
                    [
                        'title' => 'Independence within a shared system of values',
                        'paragraphs' => [
                            'You retain your entrepreneurial autonomy and the ability to grow your regional business. We are united by our mission, quality standards, responsibility to the client and respect for the contribution of every participant.',
                            'The territory, the format of brand use, the division of authority, support and the economics of cooperation are discussed individually. Together we can take on tasks that would be out of reach for a single participant.',
                        ],
                    ],
                ],
            ],
            [
                'title' => 'An international community where life and work are interesting',
                'paragraphs' => [
                    'Genla brings together people from different cities and countries. We are connected by professional challenges, an interest in new knowledge and a desire to create meaningful change.',
                    'We hold meetups, gatherings, festivals and group trips, introduce participants to one another and support community initiatives. Here you can find colleagues for a new project, discuss a difficult problem, share experience and spend time with like-minded people.',
                    'We are building an environment in which an international family of professionals helps everyone stay independent and feel supported. The community\'s opportunities grow with the contributions of its members.',
                ],
            ],
            [
                'title' => 'How to join',
                'layout' => 'steps',
                'cols' => 2,
                'items' => [
                    [
                        'title' => 'Submit a short application',
                        'paragraphs' => [
                            'Choose the role you are interested in and specify your field and contact details.',
                        ],
                    ],
                    [
                        'title' => 'Agree on a meeting time',
                        'paragraphs' => [
                            'We will message you in your chosen messenger, taking your preferences into account, and send a link once the time is confirmed.',
                        ],
                    ],
                    [
                        'title' => 'Meet the team',
                        'paragraphs' => [
                            'During the consultation or interview we will discuss your experience, goals and a possible format of cooperation. If needed, we will arrange a separate product demonstration or a discussion of your projects.',
                        ],
                    ],
                    [
                        'title' => 'Agree on terms and start working together',
                        'paragraphs' => [
                            'We will define tasks, rewards and responsibilities, formalise the agreements and provide the necessary materials and support. After that, we will help you develop projects and expand your involvement in the platform.',
                        ],
                    ],
                ],
                'after' => [
                    'Every partnership helps fulfil Genla\'s mission: combining human potential with advanced technology to achieve extraordinary results in life, career and business.',
                ],
            ],
            [
                'title' => 'Frequently asked questions',
                'layout' => 'faq',
                'items' => [
                    ['q' => 'Do I need to be a programmer to join?', 'a' => 'No. We need specialists in research, engineering, management, sales, marketing, customer service and other areas. Specify your field in the short application, and we will discuss suitable tasks at the meeting.'],
                    ['q' => 'Can I take part in developing GenClaw?', 'a' => 'Yes. We need developers, engineers, researchers, and experts in workflows, quality and security. At the meeting we will discuss how your experience can help build, deploy and improve GenClaw.'],
                    ['q' => 'Can I learn to build my own AI agents?', 'a' => 'We are developing a separate line of paid hands-on training for this. It helps specialists, entrepreneurs and teams build, configure and use their own agents for work tasks. The programme, format and cost are discussed during a consultation. Training is voluntary and is not a condition of partnership.'],
                    ['q' => 'What kind of product can I offer the platform?', 'a' => 'A ready-made boxed solution with on-premises installation, or a SaaS product that can be hosted on Genla servers. At the meeting we will discuss the solution\'s capabilities, the developer, and the delivery and hosting terms. An idea without a finished product may become a separate project task, but not an application for product placement.'],
                    ['q' => 'Can I offer a SaaS product that runs only with an external provider?', 'a' => 'Product partnership requires the ability to deploy the service in Genla infrastructure. A link to an external service that cannot be hosted this way does not fit this format.'],
                    ['q' => 'Who will be listed as the product developer?', 'a' => 'The actual developer named in the agreed product listing. Before connecting the product, we separately record the rights holder and the platform\'s rights to host, distribute and support the solution.'],
                    ['q' => 'Who sets my rate and schedule?', 'a' => 'At the meeting you tell us your desired pay and available workload. The terms of each specific task are agreed before work begins. Freedom to organise your time goes hand in hand with commitments on deadlines and quality.'],
                    ['q' => 'When does an ambassador receive their reward?', 'a' => 'We initiate the payout once the corresponding payment from the client is received and the agreed conditions are met. The rate, calculation base, documents and transfer procedure are set in advance for the relevant line of business or deal.'],
                    ['q' => 'Can I deliver projects and bring in clients at the same time?', 'a' => 'Yes, roles can be combined by agreement. In each project we separately record involvement in delivery, client acquisition and management, so the economics are clear to all parties.'],
                    ['q' => 'Does inviting ambassadors immediately grant franchisee status?', 'a' => 'Building a team lays the foundation for the transition. The status requires a sole proprietorship or LLC, at least three months of work as an ambassador, successful results and a separate contract with Genla.'],
                    ['q' => 'Can I apply for my city right away?', 'a' => 'Yes. Just specify your city in the application, and we will discuss development plans at the meeting. If the required period of cooperation has not yet been completed, we will start with the ambassador role. Submitting an application does not in itself secure a territory.'],
                    ['q' => 'What do you need for the first introduction?', 'a' => 'Provide your first name, last name and patronymic (if applicable), city of residence, field of activity, messenger contact and a convenient time to reach you. If you represent a sole proprietorship or a company, include its name. We will discuss your experience, product and terms of cooperation at the meeting.'],
                    ['q' => 'Where will the meeting link be sent?', 'a' => 'To the messenger you specify. We will first contact you and confirm the time, then send a link to the interview or consultation. The preferred time in your application helps us arrange contact; the exact meeting time is agreed with you directly.'],
                ],
            ],
        ],
        'closing' => [
            'title' => 'Let\'s get acquainted',
            'text' => 'Leave your contact details and a convenient time to reach you. We will message you in your messenger, arrange a meeting and send a link. We will discuss the details in person.',
        ],
    ],

    // Single short form on the "Become a partner" page.
    'partner_form' => [
        'title' => 'Let\'s get acquainted',
        'text' => 'Leave your contact details and a convenient time to reach you. We will message you, agree on a meeting and send you a link. We will discuss the details in person.',
        'role_label' => 'Role you are interested in',
        'roles' => [
            'specialist' => 'Specialist',
            'product' => 'Product partner',
            'ambassador' => 'Platform ambassador',
            'franchise' => 'Platform franchisee',
        ],
        'last_name_label' => 'Last name',
        'first_name_label' => 'First name',
        'middle_name_label' => 'Patronymic',
        'middle_name_hint' => 'If applicable',
        'city_label' => 'City of residence',
        'city_hint' => 'If the name is ambiguous, add the country or region.',
        'org_label' => 'Company or sole proprietor name',
        'org_hint' => 'Fill in if you are applying on behalf of a company or sole proprietorship',
        'activity_label' => 'Field of activity',
        'activity_hint' => 'What do you do or what product are you developing?',
        'messenger_label' => 'Messenger',
        'messengers' => [
            'telegram' => 'Telegram',
            'whatsapp' => 'WhatsApp',
            'max' => 'MAX',
            'other' => 'Other',
        ],
        'messenger_other_label' => 'Messenger name',
        'contact_label' => 'Messenger contact',
        'contact_hint' => 'We will send the meeting invitation here',
        'time_label' => 'Convenient time to contact you',
        'time_placeholder' => 'Weekdays after 16:00 Moscow time',
        'time_hint' => 'Specify days, time and time zone. If no time zone is given, we will go by your city.',
        'consent_before' => 'I give my ',
        'consent_link' => 'consent to the processing of my personal data',
        'consent_after' => ' for reviewing the application and arranging a meeting with Genla',
        'privacy_link' => 'Personal data processing policy',
        'submit' => 'Send application',
        'sending' => 'Sending…',
        'success' => 'Thank you! Your application has been received. We will message you in the selected messenger, agree on a time and send you a meeting link.',
        'error' => 'The application could not be sent. Your data is still in the form. Please try again.',
        'required' => 'Please fill in this field',
        'consent_required' => 'Please confirm your consent to personal data processing',
        'check_failed' => 'The check was not passed. Wait a few seconds and send the application again.',
    ],

    'partner_consent' => [
        'title' => 'Consent to personal data processing for a partnership application',
        'intro' => 'By submitting an application on the "Become a partner" page, I freely, of my own will and in my own interest give GENLA LLC my consent to the processing of my personal data in accordance with Federal Law No. 152-FZ of 27.07.2006 "On Personal Data" on the terms below.',
        'sections' => [
            ['heading' => 'Operator', 'body' => ['GENLA Limited Liability Company, TIN 9721262619, PSRN 1267700045777. Address: 2nd Vyazovsky Proezd 10, bld. 2, Moscow 109428. Email: info@genla.tech.']],
            ['heading' => 'Data processed', 'body' => ['Last name, first name, patronymic (if any), city of residence, company or sole proprietor name (if given), field of activity, chosen messenger and contact in it, convenient contact time, chosen role, as well as the submission date, page address, IP address and browser information.']],
            ['heading' => 'Purpose', 'body' => ['Reviewing the application, contacting me in the chosen messenger, agreeing on a time and arranging an introduction, interview or consultation with Genla.']],
            ['heading' => 'Processing operations', 'body' => ['Collection, recording, systematisation, storage, clarification, use and deletion, with or without automation. Only employees who handle enquiries have access to the data.']],
            ['heading' => 'Term and withdrawal', 'body' => ['The consent is valid until the purpose of processing is achieved or until it is withdrawn. Consent can be withdrawn at any time by writing to info@genla.tech.']],
        ],
    ],

    // Personal data processing consent
    'legal' => [
        'title' => 'Personal Data Processing Consent',
        'updated' => 'Published',
        'intro' => 'This Consent governs the processing of personal data of users of the Genla Technologies website (the “Operator”) and is drawn up in accordance with applicable personal data protection law.',
        'sections' => [
            [
                'heading' => 'Personal data operator',
                'body' => [
                    'GENLA Limited Liability Company (OOO «ГЕНЛА»)',
                    'Address: 109428, Moscow, 2-y Vyazovsky proezd, 10, building 2',
                    'INN: 9721262619',
                    'OGRN: 1267700045777',
                    'KPP: 772101001',
                    'Email: info@genla.tech',
                ],
            ],
            [
                'heading' => '1. What data we collect',
                'body' => [
                    'When you submit a request through a form on the site, we collect: your name, contact details (phone or email), the message text, and technical data — your IP address and browser information (user-agent).',
                    'We do not collect special categories of personal data and do not request data from minors.',
                ],
            ],
            [
                'heading' => '2. Purposes of processing',
                'body' => [
                    'The data is processed solely to respond to your request: consultation, preparing a presentation, arranging a call and supporting you with the products of the Genla ecosystem.',
                ],
            ],
            [
                'heading' => '3. Legal basis',
                'body' => [
                    'Processing is carried out on the basis of your consent, which you give by submitting a form on the site. Consent may be withdrawn at any time by request to the email below.',
                ],
            ],
            [
                'heading' => '4. Storage and protection',
                'body' => [
                    'The data is stored on the Operator’s secured servers. We apply organisational and technical measures to protect data from unauthorised access.',
                    'Data is kept no longer than necessary for the purposes of processing.',
                ],
            ],
            [
                'heading' => '5. Transfer to third parties',
                'body' => [
                    'We do not transfer your personal data to third parties, except in cases directly provided for by law.',
                ],
            ],
            [
                'heading' => '6. Your rights',
                'body' => [
                    'You have the right to request access to your data, its modification or deletion, and to withdraw your consent to processing. To do so, send a request to the Operator’s email below.',
                ],
            ],
            [
                'heading' => '7. Contact',
                'body' => [
                    'For any questions regarding personal data processing, contact: info@genla.tech',
                ],
            ],
        ],
    ],

    // Lead form (modal).
    'form' => [
        'eyebrow' => 'Genla',
        'close' => 'Close',
        'name_label' => 'Name',
        'name_placeholder' => 'How should we address you',
        'contact_label' => 'Phone',
        'contact_placeholder' => '+1 ···',
        'email_label' => 'Email',
        'email_optional' => '— optional',
        'email_placeholder' => 'Your email',
        'message_label' => 'Message',
        'message_optional' => '— optional',
        'message_placeholder' => 'Briefly about your task',
        'submit' => 'Send',
        'submitting' => 'Sending…',
        'note' => 'By clicking “Send”, you agree to the processing of your data in line with applicable data protection law.',
        'success_title' => 'Request received',
        'success_text' => 'We will get back to you shortly. Thank you for your interest in Genla.',
        'done' => 'Done',
    ],

    // Chat (interface + strings for JS).
    'chat' => [
        'name' => 'Genla',
        'status' => 'online',
        'close' => 'Close dialogue',
        'open_lab' => 'Open',
        'input_placeholder' => 'Describe your task…',
        'send' => 'Send',
        'greeting' => 'Hello. I am Genla — the intelligent core of the ecosystem. Describe your task and I will suggest which lab solves it, or arrange a consultation.',
        'fallback_reply' => 'Happy to help.',
        'error' => 'The connection dropped for a second. Please try again.',
        'suggestions' => [
            'Find a solution for my task',
            'I need GPU servers',
            'Automate processes',
            'Partner program',
        ],
    ],

    // Modal titles/leads and action labels for JS.
    'modal_titles' => [
        'consultation' => 'Book a consultation',
        'presentation' => 'Get a presentation',
        'call' => 'Request a call',
        'contact' => 'Get in touch',
        'default' => 'Send a request',
    ],

    'modal_leads' => [
        'consultation' => 'Leave your contacts — we will suggest a solution and answer your questions.',
        'presentation' => 'We will send an ecosystem presentation tailored to your request.',
        'call' => 'Leave your number — we will call you back at a convenient time.',
        'contact' => 'Leave your contacts and we will get back to you.',
        'default' => 'Leave your contacts and we will get in touch.',
    ],

    'action_labels' => [
        'consultation' => 'Book a consultation',
        'presentation' => 'Get a presentation',
        'call' => 'Request a call',
        'contact' => 'Get in touch',
        'default' => 'Send a request',
    ],

    'form_errors' => [
        'name' => 'Please enter your name',
        'contact' => 'Please enter a phone or email',
        'send_failed' => 'Could not send. Please try again later.',
    ],

    // Scripted assistant (fallback when the external agent is unavailable).
    'scripted' => [
        'greeting' => 'Hello, I am Genla. Describe your task and I will suggest a lab or arrange a consultation. Where shall we start?',
        'greeting_suggestions' => ['Free basic audit', 'Digital employees', 'Hardware for AI', 'Become a partner'],
        'overview' => 'Genla has eight labs: GenReview — research, audit and consulting; GenClaw — autonomous digital employees; GenPromo — communications and promotion; GenFleet — hardware and turnkey AI systems; GenCloud — cloud services and workspace; GenType — digital genetics and model development; GenSec — security of people, data and AI; GenX — data and research for robotics. You can start with a free basic audit. Which task is closest to yours?',
        'overview_suggestions' => ['Free basic audit', 'Digital employees', 'Cloud resources', 'AI security'],
        'lab_match' => 'It looks like :name would suit you — :sub. Open the lab page or discuss the task with the team right away?',
        'lab_match_suggestions' => ['Get a presentation', 'Book a consultation', 'Other labs'],
        'action_consultation' => 'I am ready to pass your request to the team. Describe the task in a couple of words — or leave your contacts and we will get in touch.',
        'action_presentation' => 'We will prepare a presentation for your request. Leave your contacts and we will send the materials.',
        'action_call' => 'We will arrange a call. Leave your number and we will call you back at a convenient time.',
        'action_suggestions' => ['Free basic audit', 'Digital employees', 'Hardware for AI'],
        'fallback' => 'Tell me a little more about the task and I will suggest a lab. For example: audit and choosing a solution, digital employees, promotion, hardware, cloud, model fine-tuning, security or robotics.',
        'fallback_suggestions' => ['Free basic audit', 'Digital employees', 'Promotion', 'AI security'],
    ],

    // ── Лаборатории (тексты). Структура (slug, glyph, hero_image, actions) — в config/genla.php. ──
    'labs' => [

        'ai' => [
            'name' => 'Assistant',
            'short' => 'The intelligent core',
            'hero_title' => 'Genla',
            'hero_subtitle' => 'The intelligent interface to the whole ecosystem',
            'description' => 'Genla answers questions, helps pick a solution, provides decks and arranges consultations. A single core connecting every direction of the ecosystem.',
            'features' => [
                ['title' => 'Real-time dialogue', 'text' => 'Describe the task in your own words — the system will understand the context.'],
                ['title' => 'Routing across directions', 'text' => 'It will point you to the direction that solves your task.'],
                ['title' => 'Solution matching', 'text' => 'It assembles a scenario for your infrastructure and goals.'],
                ['title' => 'Consultation and deck', 'text' => 'It passes your request to the team in one click.'],
            ],
            'advantages' => [
                ['title' => 'One interface', 'text' => 'The whole ecosystem is available from a single window.'],
                ['title' => 'Request context', 'text' => 'Answers that account for your situation, without templates.'],
                ['title' => 'Fast transition', 'text' => 'From a question to the right direction in seconds.'],
            ],
            'products' => [],
            'cases' => [
                ['title' => 'Entry point', 'text' => 'A visitor describes the task — Genla identifies the direction and suggests the next step.'],
                ['title' => 'Navigating the ecosystem', 'text' => 'A complex request is broken down into the directions that cover it.'],
            ],
            'faq' => [
                ['q' => 'Is this a live chat with a manager?', 'a' => 'No, this is the intelligent interface to the ecosystem. When needed it passes the request to the team.'],
                ['q' => 'Can I connect my own model?', 'a' => 'Yes. The reply driver is pluggable — you can use an external agent or a corporate LLM.'],
                ['q' => 'Is the conversation stored?', 'a' => 'The dialogue is used only to answer and to match a solution.'],
            ],
        ],

        'genreview' => [
            'name' => 'GenReview',
            'short' => 'Research, audit and consulting',
            'subtitle' => 'Research and solutions for your development path',
            'seo_title' => 'GenReview — research, audit and consulting | Genla',
            'seo_description' => 'Free basic audit, in-depth analytics and expert support. We help employees, entrepreneurs and companies choose the changes that are worth making.',
            'intro' => 'We help you understand what AI can do for you, choose worthwhile changes and find the right specialists. You can start with a free basic audit.',
            'mission' => 'To help people and organizations find a well-grounded path to their goals amid constant change, while saving time and resources and preserving freedom of choice.',
            'about' => [
                'GenReview is the entry point to the expertise of Genla and its partners. We help you work out which AI capabilities are useful for you specifically, what can be improved right now and which changes will justify the cost.',
                'Our work draws on the experience of our professional community and hub, collaboration with EdTech projects, and the expertise of researchers, developers, engineers and business transformation practitioners. This lets us look at a problem from several angles and compare different ways of solving it.',
                'We start with the goals of the person or organization, their current processes and constraints. Sometimes the best next step is to change how work is done, master a tool that is already available or postpone a purchase. A well-founded recommendation to build or buy nothing is a complete research outcome in its own right.',
            ],
            'sections' => [
                [
                    'title' => 'What we offer',
                    'layout' => 'cards',
                    'cols' => 3,
                    'items' => [
                        [
                            'title' => 'Free basic audit',
                            'paragraphs' => ['An initial look at your task, a discussion of processes and key pain points, a preliminary assessment of AI opportunities and a recommended next step. It helps you understand whether deeper research is needed.'],
                        ],
                        [
                            'title' => 'Extended audit',
                            'paragraphs' => ['An analysis of the client\'s situation and industry using our proprietary methodology: processes, data, resources, constraints, risks, available solutions and alternatives. The output is a set of change priorities, expected impact, cost estimates, validation criteria and a sequence of actions.'],
                        ],
                        [
                            'title' => 'Expert support',
                            'paragraphs' => ['Help with choosing contractors, writing the brief, comparing proposals, running a pilot and accepting the work. The client can work directly with independent developers and specialized teams.'],
                        ],
                    ],
                    'after' => [
                        'In the supervisory format, Genla\'s responsibility for expert support and the contractor\'s responsibility for the work are defined separately. In a turnkey project, Genla takes on the agreed implementation obligations. Guarantees apply to specific results and the conditions for achieving them.',
                    ],
                ],
            ],
            'audiences' => [
                ['You get a review of your work tasks and a clear plan for applying AI: which operations can be sped up, what can be delegated, which tools are already available and what changes the process itself requires. Based on the agreed audit scope, you receive prioritized recommendations so you can start with a useful step and avoid unnecessary subscriptions and development.'],
                ['You get an assessment of where your own time has become a bottleneck for the business: in sales, paperwork, communications or management. We help you choose between an off-the-shelf service, a process change and custom development, and define the first stage, the required spending and the criteria you can use to measure the benefit.'],
                ['You get an independent review of your idea, its intended users and the ways to implement it. In an extended study, we develop solution options, requirements for the first product, a hypothesis testing plan and resource estimates. We help you choose contractors and organize the work without overcomplicating the project too early.'],
                ['You get a rationale for AI investment decisions: which processes are a priority, how ready your data and team are, and where the constraints lie. The extended audit provides a comparison of options, a sequence of pilots, success criteria and a division of responsibilities that you can use for internal discussion and for setting tasks.'],
            ],
            'faq' => [
                ['q' => 'What does the free basic audit include?', 'a' => 'An initial discussion of the task, the main pain points and possible areas for improvement. In-depth analysis of the industry, processes and economics is part of the extended audit.'],
                ['q' => 'Can you advise us not to buy anything?', 'a' => 'Yes. If your current tools are sufficient or a change does not justify the cost, the recommendation will say so.'],
                ['q' => 'Can we work directly with the developer we choose?', 'a' => 'Yes. Genla can help you choose a contractor, write the brief and support the project. Responsibilities and the cost of supervisory work are agreed separately.'],
                ['q' => 'How do we know the audit was useful?', 'a' => 'Afterwards, it should be clear which actions are justified, what can be postponed and where to start. In the extended audit, we also define priorities, required resources and the criteria for evaluating the results of the changes.'],
            ],
            'closing' => 'Tell us about your work, project or company. We will help you determine what is worth changing now and which costs you can avoid.',
        ],

        'genclaw' => [
            'name' => 'GenClaw',
            'short' => 'Autonomous digital employees',
            'subtitle' => 'Autonomous digital employees tailored to your tasks',
            'seo_title' => 'GenClaw — autonomous digital employees | Genla',
            'seo_description' => 'Deployment of general-purpose AI agents: skills, memory, tools and background tasks. Hosted on a device, a server or in a private cloud.',
            'intro' => 'We set up digital employees for personal and business tasks, with working tools, persistent context and the ability to run in the background 24/7.',
            'mission' => 'To free up people\'s time for decisions, creativity and human interaction by handing repetitive and long-running digital work over to controlled agents.',
            'about' => [
                'GenClaw is a Genla solution for running autonomous digital employees. It helps with personal and business tasks: researching information, preparing documents, working with applications and maintaining recurring processes. The client gets a configurable workspace in which the digital employee retains context, uses the tools it needs and acts within the permissions it has been given.',
                'Together with the client, we build the digital employee\'s workspace: browser, files, applications, memory, a skill library and access rules. The agent receives a task, plans a sequence of actions, uses the available tools and returns the result for review.',
                'Skills make it possible to reuse proven ways of working, and persistent context helps take the history of interactions into account. Data and permissions are separated for different employees and departments.',
                'Work can be triggered on request, on a schedule or by an event, including round-the-clock background processing. 24/7 operation relies on always-available infrastructure, cost control and ongoing support. Actions with significant consequences are carried out within agreed permissions and confirmation rules.',
            ],
            'sections' => [
                [
                    'title' => 'Versatility you can configure',
                    'paragraphs' => [
                        'Instead of a separate project for every new task, the client gets an extensible environment where skills can be added, models swapped and services connected. Corporate knowledge search, rule-based workflows and specialized tools can all run inside this environment.',
                        'For development tasks, a digital employee can work with code, project files and checks. Its capabilities are configured for the specific process so that the team gets verifiable results and keeps control over changes.',
                        'We are developing GenClaw so that digital employees use context efficiently, reuse useful results and cut unnecessary model calls. We measure the effect by the cost of a successfully completed task at the agreed level of quality.',
                    ],
                ],
                [
                    'title' => 'Where the solution is hosted',
                    'layout' => 'list',
                    'items' => [
                        'On a mini PC or a work device, for a personal agent and tasks that suit its capacity.',
                        'On a GenBox workstation or a selected GenCube system, for local models that fit the configuration and for team work.',
                        'On a GenBlock server, for an agreed multi-user workload.',
                        'In a private cloud owned by the client, Genla or a partner, when this meets the project requirements.',
                    ],
                    'after' => [
                        'Where the agent environment runs and where the language model runs are chosen separately. An agent on a mini PC can call an external model; fully local processing requires suitable computing resources.',
                    ],
                ],
            ],
            'audiences' => [
                ['You get a configurable assistant for finding information, preparing documents, processing materials and handling routine work operations. It uses approved tools and persistent context to reduce repeated data entry. You set the goal, review the result and stay in control of significant actions.'],
                ['You get a digital employee you can assign part of your administrative work, proposal preparation, analysis and day-to-day task management. We configure skills for your processes, work schedule and spending limits. This helps keep operations running regularly with a small team or when you work on your own.'],
                ['You get an agent workspace for research, development, hypothesis testing and operational support of your project. You can start with a single task, reuse configured skills and connect new tools as needed. The solution\'s composition and the cost of running tasks are validated in a pilot.'],
                ['You get a managed rollout of digital employees with separate roles, access rights and departmental context. We define action confirmation rules, hosting requirements, cost tracking and quality criteria. A pilot lets you assess how well the solution fits a process before expanding it to other teams.'],
            ],
            'faq' => [
                ['q' => 'How is a digital employee different from a regular chatbot?', 'a' => 'It can carry out a sequence of actions with connected tools and use skills and persistent context. Its capabilities are defined by its configuration and permitted actions.'],
                ['q' => 'Can the agent run on a mini PC?', 'a' => 'Yes, if the device has enough resources for the agent environment and the selected tasks. The model can run remotely in this case. Running the model fully locally requires separate hardware selection.'],
                ['q' => 'What does 24/7 operation mean?', 'a' => 'The ability to run background and scheduled tasks on always-available infrastructure. The support level, spending limits and availability are agreed for each project.'],
                ['q' => 'Who controls what the digital employee does?', 'a' => 'The client defines roles, permitted tools and the limits of authority. Significant actions are subject to agreed confirmations and logging.'],
            ],
            'closing' => 'Choose a task you would like to hand over to a digital employee. We will define the tools, working rules, hosting and the way to verify the results.',
        ],

        'genpromo' => [
            'name' => 'GenPromo',
            'short' => 'Communications and promotion',
            'subtitle' => 'Communications and promotion in the age of artificial intelligence',
            'seo_title' => 'GenPromo — communications and promotion with AI | Genla',
            'seo_description' => 'Strategy, creative, personalized content and analytics. Communications support for entrepreneurs, startups and companies.',
            'intro' => 'We combine strategy, creative, personalized content and analytics to help products find their audience and build lasting relationships with it.',
            'mission' => 'To help useful products and ideas find their audience through precise, timely and meaningful communications.',
            'about' => [
                'GenPromo is a full-cycle communications agency that brings together strategy, creative, artificial intelligence and data.',
                'We run a continuous cycle: research the audience, formulate a hypothesis, create the content and the offer, launch the communication, analyze the response and improve the next step. Personalization takes the audience\'s situation and interests into account, and analytics helps test the practical value of each decision.',
                'Automation reduces the amount of manual preparation, content adaptation and routine reporting. Experienced specialists are responsible for strategy, concept, meaning, quality and business relationships. For each project, we bring in partners who share a responsible approach and are ready to work with new tools.',
            ],
            'sections' => [
                [
                    'title' => 'What we offer',
                    'paragraphs' => [
                        'Communications strategy, positioning, campaign and special project development, content production and adaptation, personalized engagement scenarios, marketing operations automation and results analytics.',
                        'We tie evaluation to the client\'s objective: lead quality, acquisition costs, conversion, repeat purchases, the speed of preparing materials and the consistency of communications.',
                    ],
                ],
            ],
            'audiences' => [
                ['You get help presenting your expertise: shaping your offer and preparing professional materials, content and communications for the right audience. For a company employee, the work may relate to the product or area they are responsible for. The result is a clear communications plan and an approved set of materials.'],
                ['You get coordinated promotion of your product or service, from understanding the audience and the offer to content, campaigns and lead analysis. We match the scope of work to your resources, automate suitable repetitive operations and show which actions generate a response. You can start with a single product or channel.'],
                ['You get your positioning, messaging and promotion channels tested before you scale your budget. We create launch materials, run communication experiments and analyze audience response. This helps refine the product and the offer based on real inquiries and feedback.'],
                ['You get a communications program with agreed goals, brand guidelines, content production and analytics. We organize collaboration between specialists and departments, the approval process and the personalization of materials for different audiences. Results are evaluated against selected business metrics and the quality of communications.'],
            ],
            'faq' => [
                ['q' => 'Can we start with a single campaign or product?', 'a' => 'Yes. The scope of work depends on the task: you can start with audience research, a positioning test or a single communications campaign.'],
                ['q' => 'How are results evaluated?', 'a' => 'Before launch, we choose metrics tied to the task: lead quality, conversion, acquisition costs, repeat purchases or the speed of preparing materials.'],
                ['q' => 'Who is responsible for content and publications?', 'a' => 'Specialists are responsible for strategy and quality. The approval process, publishing and the use of automation are defined for each specific project.'],
            ],
            'closing' => 'Tell us about your product, audience and promotion goals. We will define the first stage of work and the metrics we will use to evaluate the results.',
        ],

        'genfleet' => [
            'name' => 'GenFleet',
            'short' => 'Hardware and turnkey AI systems',
            'subtitle' => 'Genla hardware and turnkey systems for working with AI',
            'seo_title' => 'GenFleet — hardware and turnkey AI systems | Genla',
            'seo_description' => 'GenBook, GenCube, GenBox and GenBlock: hardware supply and rental, model and service deployment, integration and support.',
            'intro' => 'We select Genla hardware and turn it into a ready-to-use working system, complete with models, services, configuration and agreed support.',
            'mission' => 'To make the computing infrastructure you need available as part of a working solution, with clear terms for purchase, rental and support.',
            'about' => [
                'GenFleet brings together products under the Genla brand: GenBook, GenBox, GenCube and GenBlock. We select a configuration for your tasks, prepare the hardware for operation and deploy the agreed software components.',
                'The offering includes hardware supply or rental, installation of models and services, integrations, maintenance and further development of the system. The client gets an agreed solution scope and a single accountable support team.',
                'Genla takes care of organizing supply, deployment and operation, bringing in the necessary manufacturers and partners. The architecture is not tied to the mandatory use of a single cloud provider.',
            ],
            'sections' => [
                [
                    'title' => 'GenFleet products',
                    'layout' => 'cards',
                    'cols' => 4,
                    'items' => [
                        [
                            'title' => 'GenBook',
                            'image' => '/images/products/genbook.png?v=2',
                            'alt' => 'GenBook',
                            'paragraphs' => ['Professional laptops and mobile workstations with a tailored software environment and access to corporate services.'],
                        ],
                        [
                            'title' => 'GenCube',
                            'image' => '/images/products/gencube.png?v=1',
                            'alt' => 'GenCube',
                            'paragraphs' => ['Compact computing systems for personal and research AI tasks. The ability to run models locally depends on the selected configuration.'],
                        ],
                        [
                            'title' => 'GenBox',
                            'image' => '/images/products/genbox.png?v=1',
                            'alt' => 'GenBox',
                            'paragraphs' => ['Tower workstations and enterprise AI systems for models, agents, analytics and engineering tasks.'],
                        ],
                        [
                            'title' => 'GenBlock',
                            'image' => '/images/products/genblock-unicorn.png?v=2',
                            'alt' => 'GenBlock',
                            'paragraphs' => ['Rack-mounted server systems for team work and compute-intensive workloads within agreed infrastructure.'],
                        ],
                    ],
                    'after' => [
                        'Configurations are selected based on tasks, data volume and expected workload. For each product, we can discuss supply, rental and the support you need.',
                    ],
                ],
                [
                    'title' => 'What can be deployed',
                    'paragraphs' => [
                        'Autonomous digital employees, a workspace for interacting with models, local model access, corporate services, the client\'s own applications and compatible products from ecosystem partners.',
                        'The system can be located on the client\'s premises or at an agreed site. For rental, the configuration, software, support scope, maintenance and terms for changing resources are defined in advance. Integrations and licenses are listed separately in the proposal unless they are included in the package.',
                    ],
                ],
            ],
            'audiences' => [
                ['You get a work device or computing system selected for your software and tasks. The agreed scope may include setting up the environment, models and applications, access rights and support. You know which configuration you are using and what work is covered by support.'],
                ['You get a ready-made set of hardware and services without having to select and coordinate every component yourself. We help you choose between purchase and rental, the installation site and the level of maintenance you need. The proposal sets out the solution scope, costs and terms for future configuration changes.'],
                ['You get hardware for development, experiments and product launch that matches the current stage of your project. You can consider rental and a configuration for a specific workload, and define model and software environment requirements in advance. As the project grows, upgrades or additional resources can be discussed.'],
                ['You get a hardware and software system for an agreed number of users and tasks, with a hosting and operations plan. The project may include supply, deployment of models and services, integrations and support. Terms for acceptance, maintenance and infrastructure development are set in advance.'],
            ],
            'faq' => [
                ['q' => 'Can the hardware be rented?', 'a' => 'Yes. The supply or rental format, configuration, software and support scope are defined in the proposal.'],
                ['q' => 'Can you install your services and solutions from other developers?', 'a' => 'Yes. We deploy agreed Genla services, the client\'s applications and compatible partner solutions. We take into account the requirements and terms of use of each component.'],
                ['q' => 'Where will the hardware be located?', 'a' => 'On the client\'s premises or at an agreed site. The choice depends on the tasks, data requirements, operations and resource availability.'],
                ['q' => 'What does support include?', 'a' => 'The scope of maintenance, updates, support and upgrades is defined for each specific system. The proposal lists included and additional work separately.'],
            ],
            'closing' => 'Tell us about your tasks, number of users and hosting requirements. We will select the configuration, usage format and support scope.',
        ],

        'gencloud' => [
            'name' => 'GenCloud',
            'short' => 'Cloud services and workspace',
            'subtitle' => 'Cloud resources and a workspace for individuals and teams',
            'seo_title' => 'GenCloud — cloud services and workspace | Genla',
            'seo_description' => 'Virtual servers, secure workstations and corporate cloud. GenSpace for working with models and GenRouter for applications and agents.',
            'intro' => 'We provide cloud resources, secure workstations and AI tools, and help you build your own corporate environment.',
            'mission' => 'To provide access to computing and intelligent tools, with the freedom to choose where they are hosted, the level of control and the amount of resources.',
            'about' => [
                'GenCloud provides virtual servers, secure workstations, application infrastructure and the means to build a corporate cloud.',
                'We deploy the environment on Genla hardware in the data center we use, on the client\'s hardware, or at a suitable partner site. Where needed, we consider international partners, taking into account the task, service availability and data processing requirements.',
                'The client can purchase or lease hardware and use it as the foundation of their own cloud. GenCloud is responsible for organizing the environment: virtualization, access, operations, redundancy and other agreed services.',
            ],
            'sections' => [
                [
                    'title' => 'Cloud services',
                    'layout' => 'cards',
                    'cols' => 4,
                    'items' => [
                        [
                            'title' => 'VPS / VDS virtual servers',
                            'paragraphs' => ['Resources for applications, websites, corporate services, development and testing.'],
                        ],
                        [
                            'title' => 'GPU resources',
                            'paragraphs' => ['Computing power for suitable tasks such as running models, data processing and research.'],
                        ],
                        [
                            'title' => 'Data storage',
                            'paragraphs' => ['Storage with agreed capacity, access rights and operating terms.'],
                        ],
                        [
                            'title' => 'Backup',
                            'paragraphs' => ['Backup and recovery configured to meet project requirements.'],
                        ],
                        [
                            'title' => 'Environment for AI services',
                            'paragraphs' => ['Deployment of models, applications and agent systems with the chosen access control and monitoring tools.'],
                        ],
                        [
                            'title' => 'Private cloud',
                            'paragraphs' => ['A corporate environment on dedicated Genla resources, the client\'s hardware or an agreed site.'],
                        ],
                        [
                            'title' => 'Hybrid infrastructure',
                            'paragraphs' => ['Combining your own resources with suitable partner services.'],
                        ],
                        [
                            'title' => 'Secure workstations',
                            'paragraphs' => ['Virtual work environments with access to applications and data within assigned permissions.'],
                        ],
                    ],
                ],
                [
                    'title' => 'Products',
                    'layout' => 'cards',
                    'cols' => 2,
                    'items' => [
                        [
                            'title' => 'GenSpace — a workspace for interacting with different models',
                            'paragraphs' => ['A single space for research, preparing materials and solving work tasks with AI. Its purpose is to make model capabilities accessible to individuals and teams through a convenient work interface.'],
                        ],
                        [
                            'title' => 'GenRouter — model access for applications and agents',
                            'paragraphs' => ['A service for connecting language models of different tiers, including models hosted on Genla hardware. The choice is based on a balance of quality, cost, speed and data requirements. It is an infrastructure component for developers, corporate systems and agents.'],
                        ],
                    ],
                    'after' => [
                        'The set of available models, routing features and terms of use are described in the current offer for each product.',
                    ],
                ],
            ],
            'audiences' => [
                ['You get a workspace with access to the applications, files, models and computing resources you need. Depending on the task, this can be a virtual workstation or a GenSpace environment. Agreed access settings let you work with the right tools without administering servers yourself.'],
                ['You get a cloud foundation for your services and daily work: virtual resources, data storage and access to AI tools. We select the right configuration so you pay for a justified amount and know who is responsible for operations. Backup, recovery and support terms are agreed separately.'],
                ['You get an environment for developing, testing and launching your product, including model access through GenRouter and suitable computing resources. We define the requirements for workload, data and participant access. As your tasks change, the resource configuration and operating terms can be revised.'],
                ['You get a design for a corporate cloud or secure work environment that accounts for your departments, applications and data requirements. We consider your own hardware, dedicated resources and partner sites. The outcome defines the architecture and the procedures for access, redundancy, support and cost control.'],
            ],
            'faq' => [
                ['q' => 'Do we need to buy our own hardware?', 'a' => 'Not necessarily. You can use cloud resources or consider dedicated infrastructure for the task. The resource configuration and hosting format are determined when discussing the project.'],
                ['q' => 'Can you build a cloud on our servers?', 'a' => 'Yes, this option is considered during the assessment. We check compatibility, available resources and operating requirements.'],
                ['q' => 'What is the difference between GenSpace and GenRouter?', 'a' => 'GenSpace is a workspace for individuals and teams. GenRouter provides model access for software systems, developers and agents.'],
                ['q' => 'Can we use a site outside Russia?', 'a' => 'Where needed, we consider partner sites abroad. The choice depends on the task, service availability and data requirements.'],
            ],
            'closing' => 'Tell us about your applications, users and data requirements. We will propose a suitable environment and the terms for operating it.',
        ],

        'gentype' => [
            'name' => 'GenType',
            'short' => 'Digital genetics and model development',
            'subtitle' => 'Digital genetics and preserving the uniqueness of intelligent systems',
            'seo_title' => 'GenType — digital genetics and model development | Genla',
            'seo_description' => 'Genla\'s flagship lab: digital genetics, model authenticity and building cybernetic systems with stable principles and consistent quality of work.',
            'intro' => 'We are developing Genla\'s core competence: digital genetics and building authentic cybernetic systems that keep their principles and do quality work as they evolve.',
            'mission' => 'To develop authentic cybernetic systems that preserve their knowledge, values and quality of work, while supporting human autonomy and the diversity of digital genotypes.',
            'about' => [
                'GenType is Genla\'s flagship lab and home to our core competence: digital genetics and building human-centered cybernetic systems. We are developing an approach to creating, studying and preserving unique types of intelligent systems. It is based on value-oriented training and fine-tuning of language models, research into their behavior and evaluation of the quality of their work.',
                'By "digital genotype" we mean the combination of knowledge, values, ways of working with information and stable behavioral traits shaped by the model\'s architecture, data and training process. The concept of "digital DNA" helps describe which properties of a system should be preserved as it evolves and which may change.',
                'Practical work includes data preparation, adaptation and fine-tuning, behavior testing, configuring the deployment environment and feedback. Across successive versions of a system, we aim to preserve its significant traits while developing useful capabilities.',
                'A company gains the ability to develop its own intelligent core that reflects its domain, professional standards, values and culture. This core can be used in agents, corporate services and industry solutions.',
            ],
            'sections' => [
                [
                    'title' => 'GenType\'s main task',
                    'paragraphs' => [
                        'We see the main Achilles\' heel of future AI in the gap between a model\'s capabilities and its ability to reliably do the work it is meant for: to keep its goals, take feedback into account, follow important principles and meet quality requirements as the context changes and the system itself is updated.',
                        'This is the problem we solve at GenType. By authenticity we mean preserving the system\'s own body of knowledge, values and professional traits as they show up in real behavior. We test how these properties are preserved across successive model versions and in different work situations.',
                        'We are convinced that without developing this competence it is impossible to ensure the authenticity and consistent quality of full-fledged cybernetic systems: systems that receive feedback, evaluate results and adjust their actions to meet a goal. That is why we consider GenType a necessary foundation of our AI work and the main research direction at Genla.',
                    ],
                ],
                [
                    'title' => 'Diversity in an age of blended information',
                    'paragraphs' => [
                        'We see a risk that repeated use of similar data and generated content, shared evaluation criteria and constant training iterations will make the behavior of different models converge. For us, this is a reason to study how to preserve independent ways of working with knowledge, linguistic and cultural diversity, professional approaches and values.',
                        'GenType\'s task is to help create and preserve diverse digital genotypes so that the development of intelligent systems supports the uniqueness of people and organizations. Checking that these properties are preserved through updates becomes part of working with a model.',
                    ],
                ],
                [
                    'title' => 'An interdisciplinary research field',
                    'paragraphs' => [
                        'We are developing digital genetics as an interdisciplinary research field. It brings together expertise in linguistics and natural language processing (NLP), psychology, machine learning, systems cybernetics, molecular biology and other disciplines.',
                        'We study which principles of inheritance, variability, adaptation and regulation can be useful in designing digital systems. The link to biology provides research questions and models to study; specific ways of transferring them require separate validation.',
                    ],
                ],
                [
                    'title' => 'Scientific collaboration',
                    'paragraphs' => [
                        'GenType collaborates with scientific and non-profit organizations on research into intelligence, language, and the regulation and adaptation of complex systems. This collaboration lets us combine approaches from different disciplines and build research programs for developing authentic intelligent systems.',
                    ],
                ],
                [
                    'title' => 'Autonomy and development',
                    'paragraphs' => [
                        'We see the diversity of models and approaches as a condition for freedom of choice. Significant decisions about AI knowledge, goals and acceptable behavior should remain open to discussion and oversight by the people they affect.',
                        'Sovereignty includes control over data, the ability to manage a model and its operating environment, assess dependencies and replace components. It is ensured by technical, organizational and management decisions working together.',
                    ],
                ],
                [
                    'title' => 'Applied and research directions',
                    'paragraphs' => [
                        'Applied work: model behavior audits, industry data preparation, adaptation and fine-tuning, quality evaluation, designing interaction rules and integration into business systems.',
                        'Research program: building specialized models from scratch, new methods of training and knowledge transfer, interaction with bionic systems and the study of biological principles of how intelligence is organized. The scope, readiness and resources of each such project are determined separately.',
                        'Our guiding aim is the harmonious development of people, nature and the systems we create, reducing the risk of losing control and preserving human values.',
                    ],
                ],
            ],
            'audiences' => [
                ['You get the opportunity to take part in adapting an intelligent tool to your professional field: its language, terminology, work standards and important constraints. An agreed project defines which traits the system should take into account and which examples will be used to test the quality of its work.'],
                ['You get an approach to transferring your domain expertise, principles and product specifics into an intelligent service. We help define the necessary data, behavior rules and quality criteria. This lays the groundwork for developing your own model or adapting a suitable existing one while preserving the properties that matter to you.'],
                ['You get research and engineering support in choosing a model, preparing data, fine-tuning and testing behavior. We define requirements for your product\'s distinctive properties and how to evaluate them. Building a model from scratch is considered separately, when the task and available resources justify it.'],
                ['You get a development program for an intelligent core that reflects industry knowledge, professional standards and your organization\'s culture. We define the properties that must be preserved through updates, the evaluation criteria and the requirements for control over data and the model. Applied work and research tasks have separate deliverables and stages.'],
            ],
            'faq' => [
                ['q' => 'What do you mean by a digital genotype?', 'a' => 'The combination of a system\'s knowledge, values, ways of working with information and stable behavioral traits. We use this concept to study and design its individuality.'],
                ['q' => 'How do you preserve a model\'s traits when it is updated?', 'a' => 'First, we identify the significant knowledge, principles and behavioral traits. Then we define criteria and test examples to evaluate whether they are preserved in later versions of the system.'],
                ['q' => 'Can you adapt an existing model?', 'a' => 'Yes. Applied work includes data preparation, adaptation, fine-tuning and behavior testing. Whether a model needs to be built from scratch is assessed separately.'],
                ['q' => 'Why is GenType Genla\'s flagship lab?', 'a' => 'We consider an intelligent system\'s ability to keep its principles and do quality work to be the basis of its practical value. GenType develops this competence: from data preparation and model training to behavior evaluation, working with feedback and checking that significant properties are preserved through updates.'],
            ],
            'closing' => 'Tell us what knowledge, principles and traits your intelligent system should preserve. We will define an applied task or a research format.',
        ],

        'gensec' => [
            'name' => 'GenSec',
            'short' => 'Security for people, data and AI',
            'subtitle' => 'GenSec AI — intelligent security for people, data and systems',
            'seo_title' => 'GenSec AI — modular security system | Genla',
            'seo_description' => 'An intelligent core and modules for data protection, AI system testing, event monitoring, content control, and document and request handling.',
            'intro' => 'GenSec AI helps you control data, assess risks and use intelligent systems safely. Choose the modules your tasks require and build up protection step by step.',
            'mission' => 'To protect people, their data, work and resources when using AI, and to create the conditions for responsible adoption of intelligent systems.',
            'about' => [
                'GenSec develops solutions for the practical security of employees, entrepreneurs and organizations. We help determine which data intelligent systems can access, which actions they are allowed to perform and how to detect errors, policy violations and signs of threats.',
                'Our offering is built on GenSec AI and specialized modules. The client gets an agreed solution configuration, setup tailored to their processes and validation of the results on real work scenarios.',
            ],
            'sections' => [
                [
                    'title' => 'GenSec AI',
                    'paragraphs' => [
                        'GenSec AI is the intelligent model and core of the Genla security system. It is designed to analyze information, assess risks and support decisions within defined rules. Specialized modules handle specific data sources, checks and the application of agreed procedures.',
                        'GenSec AI brings together the team\'s own work in AI behavior analysis, information control and security scenario management. The set of modules is determined by the client\'s tasks. You can start with a single process and then expand the solution based on pilot results.',
                    ],
                ],
                [
                    'title' => 'GenSec AI modules',
                    'layout' => 'cards',
                    'cols' => 2,
                    'items' => [
                        [
                            'title' => 'Shield',
                            'label' => 'GenSec AI Shield — Data Protection',
                            'image' => '/images/heroes/gensec.png?v=10',
                            'alt' => 'GenSec AI Shield',
                            'paragraphs' => [
                                'Control of the connected flow of AI requests and responses: analysis of transmitted information, detection of signs of sensitive data disclosure and preparation of material for incident review.',
                                'The client gains visibility into how information is used in connected services and a basis for enforcing data handling rules. Sources, depth of analysis and actions taken on check results are defined by the project configuration.',
                            ],
                        ],
                        [
                            'title' => 'Sentinel',
                            'label' => 'GenSec AI Sentinel — Security Monitoring',
                            'paragraphs' => [
                                'Security event monitoring: collection, normalization, storage and correlation of events from connected sources. The module helps specialists see related events and investigate suspicious activity.',
                                'The client gets a unified context for analyzing AI infrastructure. Integration with existing monitoring tools, export formats and notifications are defined for each specific environment.',
                            ],
                        ],
                        [
                            'title' => 'Probe',
                            'label' => 'GenSec AI Probe — AI Security Testing',
                            'paragraphs' => [
                                'Authorized testing of AI systems and assistants within an agreed scope. It includes running selected scenarios, recording findings and preparing a report with recommendations for fixing identified issues.',
                                'The client gets material for planning fixes and re-assessment. Objectives, testing boundaries and result criteria are agreed before launch.',
                            ],
                        ],
                        [
                            'title' => 'Guardian',
                            'label' => 'GenSec AI Guardian — Content & Policy Control',
                            'paragraphs' => [
                                'Checking requests and responses against the organization\'s rules: topic restrictions, requirements for acceptable content and categories of unwanted content. The result includes the grounds for each check and warnings for review.',
                                'The client can apply an agreed policy at selected text processing points. Disputed cases are passed to a specialist for review, and the results are recorded for analysis.',
                            ],
                        ],
                        [
                            'title' => 'Counsel',
                            'label' => 'GenSec AI Counsel — Document Intelligence',
                            'paragraphs' => [
                                'Assistance with documents: finding context, summarizing content and preparing draft materials for review by a specialist.',
                                'The module can be used in legal work, records management and expert departments. The client gets prepared materials and an agreed process for working with them; significant conclusions and documents are reviewed by the responsible specialist.',
                            ],
                        ],
                        [
                            'title' => 'Dispatcher',
                            'label' => 'GenSec AI Dispatcher — Request Classification',
                            'paragraphs' => [
                                'Classification of requests according to the organization\'s categories and recommendation of the next processing route. Categories and criteria are configured using the client\'s examples.',
                                'The module helps support teams, contact centers and administrative offices organize incoming flows. Quality is evaluated on agreed data, and the way requests are handed over is defined by the organization\'s process.',
                            ],
                        ],
                        [
                            'title' => 'Endpoint',
                            'label' => 'GenSec AI Endpoint — Endpoint Control',
                            'paragraphs' => [
                                'Inventory of assigned software agents on work devices and management of agreed policies. The module helps keep track of which agents are deployed and the settings assigned to them.',
                                'This area is being developed in stages. Supported operating systems, protective actions and integrations with other endpoint security tools are defined and validated as part of a project rollout.',
                            ],
                        ],
                    ],
                ],
                [
                    'title' => 'How to choose a solution configuration',
                    'paragraphs' => [
                        'We start with your task: which data needs to be controlled, which systems need testing, which events need analysis, or which document or request handling process needs improvement.',
                        'The proposal includes the required modules, data sources, integrations and support. The feature set and the readiness of a specific scenario are confirmed during the pilot. The cost depends on the solution configuration, the number of connections, the infrastructure and the scope of work.',
                    ],
                ],
                [
                    'title' => 'How implementation works',
                    'layout' => 'steps',
                    'items' => [
                        ['title' => 'Define the task', 'paragraphs' => ['We select the process, data, systems and responsible people.']],
                        ['title' => 'Select modules', 'paragraphs' => ['We agree on features, integrations and the scope of use.']],
                        ['title' => 'Run a pilot', 'paragraphs' => ['We test the solution on approved data and agreed scenarios.']],
                        ['title' => 'Evaluate the results', 'paragraphs' => ['We measure check quality, false positives and the impact on work.']],
                        ['title' => 'Set up operations', 'paragraphs' => ['We document usage rules, support and the next stages of development.']],
                    ],
                ],
            ],
            'audiences' => [
                ['You get clear rules for working with AI, documents and work information, along with tools configured for the chosen process. You can focus on controlling transmitted data, checking content or preparing materials. Within the agreed scope, we define access rights, how results are reviewed and what to do when suspicious events occur.'],
                ['You get a solution tailored to the specific risks and operations of your business: handling customer data, documents, requests and AI services. You can start with one module and a clear budget. The pilot delivers a validated scenario, usage instructions and agreed support terms.'],
                ['You get the ability to test the security of your product\'s AI features, configure data and content processing rules and set up event analysis. For the selected modules, we define test scenarios and quality criteria. This helps identify issues, plan fixes and verify results before expanding product use.'],
                ['You get a modular architecture that takes into account departmental requirements and existing security tools. You can combine AI system testing, data control, event monitoring, and document and request processing. The integrations, access rights, acceptance criteria and responsibilities of each party are set out in the project.'],
            ],
            'faq' => [
                ['q' => 'What is GenSec AI and how do the modules differ?', 'a' => 'GenSec AI is the intelligent model and core of the solution. The modules perform specialized functions: Shield works with data, Sentinel with security events, Probe with AI system testing, Guardian with content rules, Counsel with documents, Dispatcher with requests, and Endpoint with agents and policies on devices.'],
                ['q' => 'Do we need to connect all the modules?', 'a' => 'No. The configuration depends on your task. You can start with one module and expand the solution after evaluating the results.'],
                ['q' => 'Can we use our own servers?', 'a' => 'The hosting option is considered during design. Resource and compatibility requirements depend on the selected modules and integrations.'],
                ['q' => 'Will the solution control all services and devices?', 'a' => 'The scope is determined by the connected sources, access rights and agreed scenarios. The list of devices and services is set out in the project.'],
                ['q' => 'Can we connect our existing security monitoring system?', 'a' => 'The event format, connection method and data exchange capabilities are checked for the specific system and the selected set of modules.'],
                ['q' => 'Does GenSec AI automatically fix all detected issues?', 'a' => 'Check results help determine further actions. Fixes and automated responses are performed only within separately configured and tested scenarios, with agreed permissions.'],
                ['q' => 'How are implementation results confirmed?', 'a' => 'Before the pilot, we agree on test data and evaluation criteria. The report records the results, limitations and next steps.'],
            ],
            'closing' => 'Tell us which systems and data you use and which process you want to protect or improve. We will select a GenSec AI configuration and propose a first stage.',
        ],

        'genx' => [
            'name' => 'GenX',
            'short' => 'Data and research for robotics',
            'subtitle' => 'Data and research for the robotics of the future',
            'seo_title' => 'GenX — data and research for robotics | Genla',
            'seo_description' => 'Collecting and preparing data for training robots and autonomous systems. Research collaboration with manufacturers, companies and scientific teams.',
            'intro' => 'We work on data for training the robots of the future. We invite manufacturers, researchers and teams to join us in experiments.',
            'status' => 'Status: research direction.',
            'mission' => 'To build a high-quality foundation for training robots that can interact usefully and safely with people and the world around them.',
            'about' => [
                'GenX is Genla\'s research lab focused on collecting and preparing data for robotics and autonomous systems.',
                'We work with manufacturers of robots and autonomous solutions in Russia and consider joint projects across different areas of life. We pay particular attention to data that helps train robotic systems in actions, environmental perception and interaction with people.',
                'Our work covers collaborative systems that operate alongside people, as well as autonomous solutions. For each study, we define the scenarios, collection methods, data quality requirements, terms of use and evaluation criteria.',
            ],
            'sections' => [
                [
                    'title' => 'Collaboration formats',
                    'paragraphs' => [
                        'Jointly defining research objectives, organizing data collection, preparing and annotating materials, building training and validation datasets, and taking part in experimental programs run by manufacturers and research teams.',
                        'At this stage, GenX conducts research activities. Information about projects and possible forms of participation is provided on request when discussing collaboration.',
                    ],
                ],
            ],
            'audiences' => [
                ['If your work involves robotics, data or research into human-machine interaction, you can offer your expertise and take part in a joint project. The form of participation, the research objective and the expected outcome are defined in advance. This is an opportunity to work on applied questions of data collection and preparation.'],
                ['You get the opportunity to discuss a task that robotics could help with in the future and define the subject of a research study. Together we clarify the use case, the data required and potential participants. The first stage can result in a research program or a rationale for a further experiment.'],
                ['You get a partner for organizing data collection, preparing materials and developing test scenarios for a robotic system. We agree on requirements for data quality, annotation and use. This work can help test a hypothesis and lay the groundwork for subsequent model training and evaluation.'],
                ['You get the opportunity to build a joint research program grounded in your organization\'s real processes. We define data preparation tasks, experimental conditions, participant roles and result criteria. Details about current projects are provided when discussing specific collaboration.'],
            ],
            'faq' => [
                ['q' => 'Can we order turnkey robotization of our business from you?', 'a' => 'At this stage, GenX conducts research activities. Participation in an applied project is discussed individually.'],
                ['q' => 'What systems do you work with?', 'a' => 'We research data preparation tasks for collaborative robots and autonomous systems together with manufacturers and specialized teams.'],
                ['q' => 'How can we get details about your projects?', 'a' => 'Submit a research collaboration request and describe your task. We will provide information relevant to a possible joint project.'],
            ],
            'closing' => 'Tell us about your platform, research or applied task. We will discuss opportunities to work together and provide additional information on request.',
        ],

    ],

];
