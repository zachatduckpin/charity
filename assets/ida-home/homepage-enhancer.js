(() => {
  if (window.__idaHomepageEnhancerLoaded) {
    return;
  }

  window.__idaHomepageEnhancerLoaded = true;

  const HERO_VIDEO_SOURCE = "/assets/ida-home/ida-video.mp4";
  const HERO_COPY_LINES = [
    "structured global relationship and membership platform,",
    "a collaboration and capacity-building engine, and a",
    "strategic model for distributed network governance",
    "within the International Dyslexia Association.",
  ];

  const AUDIENCE_ITEMS = [
    {
      src: "/assets/ida-home/audience-intervention.png",
      title: "intervention and support services",
    },
    {
      src: "/assets/ida-home/audience-advocacy.png",
      title: "dyslexia awareness and advocacy",
    },
    {
      src: "/assets/ida-home/audience-literacy.png",
      title: "learning difficulties and literacy support",
    },
    {
      src: "/assets/ida-home/audience-training.png",
      title: "professional training and educator development",
    },
    {
      src: "/assets/ida-home/audience-assessment.png",
      title: "educational and psychological assessment",
    },
    {
      src: "/assets/ida-home/audience-policy.png",
      title: "policy, systems development, and inclusive practice",
    },
  ];

  const AUDIENCE_INITIAL_ACTIVE_INDEX = 2;
  const AUDIENCE_AUTOPLAY_MS = 6500;
  const AUDIENCE_TRANSITION_MS = 840;
  const AUDIENCE_FRAME_SLOTS = [-2, -1, 0, 1, 2, 3];
  const AUDIENCE_SLOT_CLASSES = {
    "-3": "is-hidden-left",
    "-2": "is-exit-left",
    "-1": "is-left",
    0: "is-active",
    1: "is-right",
    2: "is-enter-right",
    3: "is-hidden-right",
  };

  const HIDE_SELECTORS = [
    ".ch-hero-section-2",
    ".ch-supports-section",
    ".ch-fea-section",
    ".ch-contact-section",
    ".ch-newest-section.ch-newest-section-2",
    ".ch-vounteers-section",
    ".ch-about-section.ch-about-section-2",
    ".home-2-counter-section",
    ".ch-latest-news-section.ch-latest-news-section-2",
    ".home-2-testimonial-section",
    ".home-2-faq-section",
    ".ch-footer-section",
  ];

  const FOOTER_LOGO_FALLBACK_SRC = "/backend/assets/images/17452878561714882831.png";
  const HEADER_LOGO_EXTERNAL_HREF = "https://dyslexiaida.org/";
  const HEADER_LOGO_EXTERNAL_REL = "nofollow noopener noreferrer";
  const FOOTER_NAV_GROUPS = [
    {
      title: "Network",
      links: ["Membership", "Directory"],
    },
    {
      title: "Engage",
      links: ["Events", "Projects"],
    },
    {
      title: "Info",
      links: ["Contact Us", "Sign in"],
    },
  ];

  const MEMBERSHIP_PAGE_HREF = "/membership";
  const GLOBAL_NETWORK_APPLICATION_PAGE_HREF = "/membership/application";
  const DIRECTORY_PAGE_HREF = "/directory";
  const EVENTS_PAGE_HREF = "/events";
  const COLLABORATIVE_PROJECTS_PAGE_HREF = "/collaborative-projects";
  const PROJECT_IDEA_SUBMISSION_PAGE_HREF = "/collaborative-projects/submit-a-project-idea";
  const NEWS_SPOTLIGHT_PAGE_HREF = "/news-and-global-spotlight";
  const CONTACT_PAGE_HREF = "/contact";
  const LOGIN_PAGE_HREF = "/login";
  const GLOBAL_NETWORK_APPLICATION_HERO_IMAGE_SRC = "/assets/membership-connect.png";
  const DIRECTORY_HERO_IMAGE_SRC = "/assets/directory/GN_People.jpg";
  const EVENTS_HERO_IMAGE_SRC = "/assets/events-hero.jpg";
  const COLLABORATIVE_PROJECTS_HERO_IMAGE_SRC = "/assets/collaborative-projects/hero.jpg";
  const PROJECT_IDEA_SUBMISSION_HERO_IMAGE_SRC = "/assets/collaborative-projects/planning.jpg";
  const NEWS_SPOTLIGHT_HERO_IMAGE_SRC = "/assets/news-spotlight/hero.jpg";
  const NEWS_SPOTLIGHT_FEATURED_IMAGE_SRC = "/assets/news-spotlight/featured-article.png";
  const CONTACT_HERO_IMAGE_SRC = "/assets/contact/hero.jpg";
  const LOGIN_HERO_IMAGE_SRC = "/assets/sign-in/login.jpg";
  const LEAFLET_STYLESHEET_SRC = "https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css";
  const LEAFLET_SCRIPT_SRC = "https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js";
  const JSVECTORMAP_STYLESHEET_SRC = "https://cdn.jsdelivr.net/npm/jsvectormap@1.7.0/dist/jsvectormap.min.css";
  const JSVECTORMAP_SCRIPT_SRC = "https://cdn.jsdelivr.net/npm/jsvectormap@1.7.0/dist/jsvectormap.min.js";
  const JSVECTORMAP_WORLD_MAP_SRC = "https://cdn.jsdelivr.net/npm/jsvectormap@1.7.0/dist/maps/world.js";
  const PRIMARY_NAV_ITEMS = [
    { label: "Home", href: "/" },
    { label: "Membership", href: MEMBERSHIP_PAGE_HREF },
    { label: "Directory", href: DIRECTORY_PAGE_HREF },
    { label: "Events", href: EVENTS_PAGE_HREF },
    { label: "Collaborative Projects", href: COLLABORATIVE_PROJECTS_PAGE_HREF },
    { label: "News and Global Spotlight", href: NEWS_SPOTLIGHT_PAGE_HREF },
    { label: "Contact", href: CONTACT_PAGE_HREF },
  ];
  const MEMBERSHIP_HIDE_SELECTORS = [
    ".breadcrumb-area",
    ".breadcrumb-section",
    ".error-section",
    ".container.mt-60.mb-120",
    ".ch-hero-section-2",
    ".ch-supports-section",
    ".ch-fea-section",
    ".ch-contact-section",
    ".ch-newest-section",
    ".ch-vounteers-section",
    ".ch-about-section",
    ".ch-latest-news-section",
    ".home-2-counter-section",
    ".home-2-testimonial-section",
    ".home-2-faq-section",
  ];
  const DIRECTORY_HIDE_SELECTORS = [...MEMBERSHIP_HIDE_SELECTORS];
  const EVENTS_HIDE_SELECTORS = [...MEMBERSHIP_HIDE_SELECTORS];
  const COLLABORATIVE_PROJECTS_HIDE_SELECTORS = [...MEMBERSHIP_HIDE_SELECTORS];
  const PROJECT_IDEA_SUBMISSION_HIDE_SELECTORS = [...MEMBERSHIP_HIDE_SELECTORS];
  const GLOBAL_NETWORK_APPLICATION_HIDE_SELECTORS = [...MEMBERSHIP_HIDE_SELECTORS];
  const NEWS_SPOTLIGHT_HIDE_SELECTORS = [...MEMBERSHIP_HIDE_SELECTORS];
  const CONTACT_HIDE_SELECTORS = [...MEMBERSHIP_HIDE_SELECTORS];
  const LOGIN_SHOWCASE_FEATURES = [
    {
      icon: "/assets/sign-in/Folder.png",
      title: "Profile Managements",
      copy: "Update your organization's directory listing and information.",
    },
    {
      icon: "/assets/sign-in/Calendar.png",
      title: "Events & Registrations",
      copy: "Register for sessions, view upcoming events, and track activity.",
    },
    {
      icon: "/assets/sign-in/Accessibility.png",
      title: "Resources & Tools",
      copy: "Access shared resources, collaborative tools and program documents.",
    },
  ];
  const MEMBERSHIP_SUPPORT_CARDS = [
    {
      index: "01",
      title: "International Visibility",
      copy: "Your organization gains a clear, visible presence within a growing global ecosystem.",
    },
    {
      index: "03",
      title: "Events and Discussions",
      copy: "Participation in Sip and Chat sessions, themed practice forums, and more.",
    },
    {
      index: "02",
      title: "Stronger Peer Exchange",
      copy: "Access to ongoing conversations, forums, and international learning opportunities.",
    },
    {
      index: "04",
      title: "Project Collaboration",
      copy: "Pathways to collaborative projects, regional initiatives, and practical partnerships.",
    },
  ];
  const MEMBERSHIP_TIERS = [
    {
      tier: "Tier 1",
      title: "Associate",
      items: [
        "Member directory listing",
        "Access to Sip and Chat sessions",
        "International visibility",
        "Shared resources access",
      ],
    },
    {
      tier: "Tier 2",
      title: "Contributor",
      items: [
        "All Associate benefits",
        "Active collaboration access",
        "Program activity participation",
        "Network dialogue contribution",
      ],
    },
    {
      tier: "Tier 3",
      title: "Partner",
      items: [
        "All Contributor benefits",
        "Strategic network role",
        "Governance participation",
        "Network development influence",
      ],
    },
  ];
  const MEMBERSHIP_KEYWORDS = [
    { label: "education", modifier: "education" },
    { label: "Research", modifier: "research" },
    { label: "Training", modifier: "training" },
    { label: "Assessment", modifier: "assessment" },
    { label: "Intervention", modifier: "intervention" },
    { label: "Advocacy", modifier: "advocacy" },
  ];
  const BENEFITS_AUTOPLAY_MS = 7000;
  const BENEFITS_CARD_VISIBLE_COUNT = 3;
  const BENEFITS_TRANSITION_OUT_MS = 280;
  const BENEFITS_TRANSITION_UNDER_MS = 520;
  const BENEFITS_TRANSITION_MS = BENEFITS_TRANSITION_OUT_MS + BENEFITS_TRANSITION_UNDER_MS;
  const BENEFITS_ITEMS = [
    {
      title: "Visibility",
      copy: "Gain stronger visibility through member listings, spotlight features, event participation, and strategic communications across the international network.",
      modifier: "visibility",
      lottiePath: "/assets/ida-home/lottie/benefits-visibility.json",
    },
    {
      title: "Connection",
      copy: "Join a growing network of organizations, leaders, and professionals working across countries and systems to support dyslexia and literacy.",
      modifier: "connection",
      lottiePath: "/assets/ida-home/lottie/benefits-connection.json",
    },
    {
      title: "Knowledge Exchange",
      copy: "Take part in conversations, forums, and international learning opportunities centered on evidence-based practice and real-world systems.",
      modifier: "knowledge",
      lottiePath: "/assets/ida-home/lottie/benefits-knowledge.json",
    },
    {
      title: "Collaboration",
      copy: "Explore collaborative projects, regional initiatives, and practical partnerships that extend beyond symbolic affiliation.",
      modifier: "collaboration",
      lottiePath: "/assets/ida-home/lottie/benefits-collaboration.json",
    },
    {
      title: "Strategic Positioning",
      copy: "Benefit from clearer pathways for engagement, stronger alignment with IDA, and a more coherent framework for international participation.",
      modifier: "positioning",
      lottiePath: "/assets/ida-home/lottie/benefits-positioning.json",
    },
  ];
  const DIRECTORY_MEMBERS = [
    {
      id: "africa-dyslexia-organization",
      name: "Africa Dyslexia Organization (ADO)",
      cardTitle: "Africa Dyslexia Organization, Ghana",
      location: "Ghana",
      tier: "Associate",
      image: "/assets/directory/ghana-logo.png",
      address: "Ghana",
      description: "A pan-African nonprofit founded in 2020 advancing early identification of learning differences, structured literacy, and inclusive education. ADO has trained more than 5,000 educators and built a network of 330+ dyslexia advocates across 38 African countries, partnering with governments, universities, and the private sector.",
      phone: "",
      email: "",
      website: "www.africadyslexia.org",
      websiteUrl: "https://www.africadyslexia.org",
      socialLinks: [
        { platform: "linkedin", label: "LinkedIn", url: "https://www.linkedin.com/company/africadyslexiaorg/" },
        { platform: "youtube", label: "YouTube", url: "https://www.youtube.com/@africadyslexiaorg" },
        { platform: "facebook", label: "Facebook", url: "https://www.facebook.com/africadyslexiaorg/" },
        { platform: "instagram", label: "Instagram", url: "https://www.instagram.com/africadyslexiaorg/" },
        { platform: "x", label: "Twitter/X", url: "https://twitter.com/AfricaDyslexia" },
      ],
      regionCode: "GH",
      lat: 5.6037,
      lng: -0.187,
      mapZoom: 5,
      highlightRadius: 250000,
    },
    {
      id: "australian-dyslexia-association",
      name: "Australian Dyslexia Association (ADA)",
      location: "Australia",
      tier: "Associate",
      image: "/assets/directory/australian-dyslexia-association-logo.png",
      address: "Australia",
      description: "An incorporated, not-for-profit Australian association that supports people and families affected by dyslexia through advocacy, public education, identification pathways, evidence-based intervention, and multisensory structured-language training.",
      phone: "",
      email: "",
      website: "dyslexiaassociation.org.au",
      websiteUrl: "https://dyslexiaassociation.org.au",
      socialLinks: [
        { platform: "linkedin", label: "LinkedIn", url: "https://au.linkedin.com/company/australian-dyslexia-association" },
        { platform: "facebook", label: "Facebook", url: "https://www.facebook.com/lightitredfordyslexia/" },
      ],
      regionCode: "AU",
      lat: -35.2809,
      lng: 149.13,
      mapZoom: 4,
      highlightRadius: 450000,
    },
    {
      id: "bellavista",
      name: "Bellavista S.H.A.R.E. (division of Bellavista School)",
      cardTitle: "Bellavista S.H.A.R.E., South Africa",
      location: "Johannesburg, South Africa",
      tier: "Associate",
      image: "/assets/directory/south-africa-logo.png",
      address: "Johannesburg, South Africa",
      description: "Bellavista S.H.A.R.E. is the education, research, and professional-development hub of Bellavista School, a leading non-profit remedial school and assessment unit in Johannesburg. It delivers evidence-based training and its flagship two-year Award in Remedial Education to teachers and therapists across South Africa and globally.",
      phone: "",
      email: "",
      website: "",
      websiteUrl: "",
      regionCode: "ZA",
      lat: -26.2041,
      lng: 28.0473,
      mapZoom: 5,
      highlightRadius: 320000,
    },
    {
      id: "brazilian-dyslexia-association",
      name: "Brazilian Dyslexia Association",
      location: "Brazil",
      tier: "Contributor",
      image: "/assets/directory/brazilian-dyslexia-association-logo.png",
      address: "Brazil",
      description: "Founded in 1983, ABD is a Brazilian non-profit organization supporting people with dyslexia and other learning disorders, their families, educators, and health professionals through information services, multidisciplinary assessment, professional education, research, and advocacy.",
      phone: "",
      email: "",
      website: "dislexia.org.br",
      websiteUrl: "https://www.dislexia.org.br",
      socialLinks: [
        { platform: "facebook", label: "Facebook", url: "https://www.facebook.com/AssociacaoBrasileiradeDislexia/" },
        { platform: "linkedin", label: "LinkedIn", url: "https://www.linkedin.com/company/associa%C3%A7%C3%A3o-brasileira-de-dislexia-abd" },
        { platform: "x", label: "Twitter/X", url: "https://twitter.com/abdislexia" },
      ],
      regionCode: "BR",
      lat: -15.7939,
      lng: -47.8828,
      mapZoom: 4,
      highlightRadius: 420000,
    },
    {
      id: "ccet",
      name: "Center for Child Evaluation and Teaching (CCET)",
      cardTitle: "CCET, Kuwait",
      location: "Kuwait",
      tier: "Contributor",
      image: "/assets/directory/kuwait-logo.png",
      address: "Kuwait",
      description: "Established in Kuwait in 1984, CCET is a non-governmental organization providing assessment for learning-disabled children, training for teachers, educational psychologists, and social workers, standardized-test development for Kuwaiti children, and morning and afternoon intervention programmes in Arabic, mathematics, and English.",
      phone: "",
      email: "info@ccetkuwait.org",
      website: "ccetkuwait.org",
      websiteUrl: "https://ccetkuwait.org",
      regionCode: "KW",
      lat: 29.3759,
      lng: 47.9774,
      mapZoom: 5,
      highlightRadius: 230000,
    },
    {
      id: "dr-anjali-morris-foundation",
      name: "Dr. Anjali Morris Education and Health Foundation (AMF)",
      location: "Pune, India",
      tier: "Contributor",
      image: "/assets/directory/dr-anjali-morris-foundation-logo.png",
      address: "Pune, India",
      description: "A Pune-based not-for-profit organization established in 2008 to support students with Specific Learning Disabilities and ADHD through assessment, intervention, educator training, school-based support, community awareness, and research.",
      phone: "",
      email: "",
      website: "morrisfoundation.in",
      websiteUrl: "https://morrisfoundation.in",
      socialLinks: [
        { platform: "facebook", label: "Facebook", url: "https://www.facebook.com/pages/category/Education/Dr-Anjali-Morris-Education-and-Health-Foundation-362439797181223/" },
        { platform: "instagram", label: "Instagram", url: "https://www.instagram.com/_amf_pune/" },
        { platform: "linkedin", label: "LinkedIn", url: "https://in.linkedin.com/company/dr.-anjali-morris-education-&-health-foundation" },
        { platform: "youtube", label: "YouTube", url: "https://www.youtube.com/@MorrisFoundation" },
      ],
      regionCode: "IN",
      lat: 28.6139,
      lng: 77.209,
      mapZoom: 4,
      highlightRadius: 360000,
    },
    {
      id: "dyslexia-social-support-botswana",
      name: "Dyslexia and Social Support Services Botswana (Botswana Dyslexia Association)",
      cardTitle: "Botswana Dyslexia Association",
      location: "Botswana",
      tier: "Associate",
      image: "/assets/directory/botswana-logo.png",
      address: "Botswana",
      description: "A non-profit trust based in Mmatseta Village, Botswana, addressing and advocating for children with learning disabilities. Services include free counselling, educator training, educational-psychologist assessments, vocational skills transfer, and after-school remedial classes for dozens of beneficiaries.",
      phone: "",
      email: "",
      website: "",
      websiteUrl: "",
      socialLinks: [
        { platform: "facebook", label: "Facebook", url: "https://www.facebook.com/Dyslexia-support-services-Botswana-105197044724160/" },
        { platform: "linkedin", label: "LinkedIn", url: "https://www.linkedin.com/in/letang-jiri-0683201bb/" },
      ],
      regionCode: "BW",
      lat: -24.6282,
      lng: 25.9231,
      mapZoom: 5,
      highlightRadius: 260000,
    },
    {
      id: "singapore",
      name: "Dyslexia Association of Singapore (DAS)",
      location: "Singapore",
      tier: "Partner",
      image: "/assets/directory/singapore-logo.png",
      address: "Singapore",
      description: "A social enterprise dedicated to helping people with dyslexia achieve their potential, DAS provides assessment, specialised education, and intervention programmes across Singapore.",
      phone: "",
      email: "",
      website: "das.org.sg",
      websiteUrl: "https://das.org.sg",
      socialLinks: [
        { platform: "facebook", label: "Facebook", url: "https://www.facebook.com/DyslexiaSG/" },
        { platform: "linkedin", label: "LinkedIn", url: "https://sg.linkedin.com/company/dyslexiasg" },
        { platform: "youtube", label: "YouTube", url: "https://www.youtube.com/@DyslexiaAssociationofSingapore" },
      ],
      regionCode: "SG",
      lat: 1.3521,
      lng: 103.8198,
      mapZoom: 6,
      highlightRadius: 160000,
    },
    {
      id: "uk",
      name: "The Dyslexia Foundation",
      cardTitle: "The Dyslexia Foundation, UK",
      location: "United Kingdom",
      tier: "Contributor",
      image: "/assets/directory/uk-logo.png",
      address: "United Kingdom",
      description: "A UK national charity supporting dyslexic adults across education, employment, health, and welfare. Working with the Department for Work and Pensions, it delivers a targeted welfare programme, supports university students in North West England, provides NHS diagnostic assessment projects, and produces the Words Fail Me podcast.",
      phone: "",
      email: "",
      website: "dyslexia-help.org",
      websiteUrl: "https://dyslexia-help.org",
      regionCode: "GB",
      lat: 53.4858,
      lng: -3.0176,
      mapZoom: 5,
      highlightRadius: 260000,
    },
    {
      id: "dyslexia-ireland",
      name: "Dyslexia Ireland",
      location: "Ireland",
      tier: "Associate",
      image: "/assets/directory/ireland-logo.png",
      address: "Ireland",
      description: "Founded in 1972, Dyslexia Ireland is the national representative body for dyslexia and dyscalculia in Ireland, providing assessment, specialist tuition, parent courses, teacher training, workplace awareness training, and advocacy, alongside its DyslexiaHub.ie and AdultDyslexiaHub.ie online learning platforms.",
      phone: "",
      email: "",
      website: "www.dyslexia.ie",
      websiteUrl: "https://www.dyslexia.ie",
      socialLinks: [
        { platform: "facebook", label: "Facebook", url: "https://www.facebook.com/DyslexiaIreland/" },
      ],
      regionCode: "IE",
      lat: 53.3498,
      lng: -6.2603,
      mapZoom: 5,
      highlightRadius: 220000,
    },
    {
      id: "dyslexia-organization-kenya",
      name: "Dyslexia Organisation Kenya (DOK)",
      cardTitle: "Dyslexia Organisation Kenya",
      location: "Kenya",
      tier: "Contributor",
      image: "/assets/directory/kenya-logo.png",
      address: "Kenya",
      description: "Founded in 2010, DOK is a pioneering Kenyan non-profit advancing dyslexia and neurodiversity awareness, early identification, evidence-based intervention, and policy reform. It has reached an estimated 475,000 parents, trained over 95,000 educators, conducted more than 9,500 learner assessments, and established Africa's first university-accredited Certificate Course in Dyslexia.",
      phone: "",
      email: "",
      website: "www.dyslexiakenya.org",
      websiteUrl: "https://www.dyslexiakenya.org",
      regionCode: "KE",
      lat: -1.2921,
      lng: 36.8219,
      mapZoom: 5,
      highlightRadius: 280000,
    },
    {
      id: "dyslexia-scotland",
      name: "Dyslexia Scotland",
      location: "Scotland",
      tier: "Associate",
      image: "/assets/directory/dyslexia-scotland-logo.png",
      address: "Scotland",
      description: "Scotland's national voluntary and membership organization for dyslexia, working to build a dyslexia-friendly Scotland through services, policy influence, professional learning, local branches, and a national helpline.",
      phone: "",
      email: "",
      website: "dyslexiascotland.org.uk",
      websiteUrl: "https://dyslexiascotland.org.uk",
      socialLinks: [
        { platform: "facebook", label: "Facebook", url: "https://www.facebook.com/DyslexiaScotland/" },
        { platform: "instagram", label: "Instagram", url: "https://www.instagram.com/dyslexiascotland/" },
        { platform: "linkedin", label: "LinkedIn", url: "https://www.linkedin.com/company/dyslexiascotland" },
        { platform: "x", label: "Twitter/X", url: "https://twitter.com/DyslexiaScotlan" },
        { platform: "youtube", label: "YouTube", url: "https://www.youtube.com/channel/UC1aSDfa8h-3IooqEvownR7A" },
      ],
      regionCode: "GB",
      lat: 55.9533,
      lng: -3.1883,
      mapZoom: 5,
      highlightRadius: 220000,
    },    
    {
      id: "maharashtra-dyslexia-association",
      name: "Maharashtra Dyslexia Association (MDA)",
      cardTitle: "Maharashtra Dyslexia Association",
      location: "Mumbai, India",
      tier: "Contributor",
      image: "/assets/directory/maharashtra-dyslexia-association-logo.svg",
      address: "Mumbai, India",
      description: "For three decades, MDA has advanced assessment, remediation, professional training, and advocacy for individuals with Specific Learning Disabilities in India, operating resource centres in Dadar, Deonar, and Vile Parle in Mumbai and training thousands of educators, psychologists, and therapists nationally.",
      phone: "",
      email: "",
      website: "www.mdamumbai.com",
      websiteUrl: "https://www.mdamumbai.com",
      socialLinks: [
        { platform: "facebook", label: "Facebook", url: "https://www.facebook.com/mdadyslexia/" },
      ],
      regionCode: "IN",
      lat: 19.076,
      lng: 72.8777,
      mapZoom: 5,
      highlightRadius: 260000,
    },
    {
      id: "pathways-foundation",
      name: "Pathways Foundation Limited",
      cardTitle: "Pathways Foundation, Hong Kong",
      location: "Hong Kong",
      tier: "Contributor",
      image: "/assets/directory/hong-kong-logo.png",
      address: "Hong Kong",
      description: "Established in 2001, Pathways is a registered Hong Kong charity operating two learning centres offering evidence-based intervention, assessment, and therapy for students with dyslexia. It is the first IDA Global Network partner in Hong Kong and contributed Chinese translations of IDA's Definition of Dyslexia and Fact Sheets.",
      phone: "",
      email: "info@pathways.org.hk",
      website: "www.pathways.org.hk",
      websiteUrl: "https://www.pathways.org.hk",
      regionCode: "HK",
      lat: 22.3193,
      lng: 114.1694,
      mapZoom: 6,
      highlightRadius: 140000,
    },
    {
      id: "turkey-dyslexia-foundation",
      name: "Turkish Dyslexia Foundation",
      location: "Turkey",
      tier: "Associate",
      image: "/assets/directory/turkish-dyslexia-foundation-logo.png",
      address: "Turkey",
      description: "A Turkish foundation supporting children with specific learning differences, including dyslexia, dyscalculia, and dysgraphia, while promoting informed public understanding, educator preparation, educational programmes, and access to support.",
      phone: "",
      email: "",
      website: "tudiv.org.tr",
      websiteUrl: "https://www.tudiv.org.tr/en",
      socialLinks: [
        { platform: "instagram", label: "Instagram", url: "https://www.instagram.com/turkiyedisleksivakfi/" },
      ],
      regionCode: "TR",
      lat: 39.9334,
      lng: 32.8597,
      mapZoom: 5,
      highlightRadius: 300000,
    },
  ];
  const ROUTE_META = {
    default: {
      title: "International Dyslexia Association",
      description: "International Dyslexia Association global network information.",
    },
    home: {
      title: "Home | International Dyslexia Association",
      description: "The IDA Global Network is a structured global relationship and membership platform within the International Dyslexia Association.",
    },
    membership: {
      title: "Membership | International Dyslexia Association",
      description: "Explore IDA Global Network membership tiers, eligibility, and supports for organizations advancing dyslexia and literacy.",
    },
    globalNetworkApplication: {
      title: "Global Network Application | International Dyslexia Association",
      description: "Complete the multi-step IDA Global Network membership application preview for prospective organizations.",
    },
    directory: {
      title: "Directory | International Dyslexia Association",
      description: "Browse IDA Global Network directory members and explore highlighted locations across the world.",
    },
    events: {
      title: "Events | International Dyslexia Association",
      description: "Explore Events and Sip and Chat sessions, event types, upcoming events, and registrations across the IDA Global Network.",
    },
    collaborativeProjects: {
      title: "Collaborative Projects | International Dyslexia Association",
      description: "Collaborative projects allow the Network to move from conversation to practical action through cross-country exchange, shared learning, and strategic initiatives.",
    },
    projectIdeaSubmission: {
      title: "Project Idea Submission | International Dyslexia Association",
      description: "Submit a collaborative project idea for review by the IDA Global Network Committee using the official partner and contributor organization form.",
    },
    newsSpotlight: {
      title: "News and Global Spotlight | International Dyslexia Association",
      description: "Explore news and global spotlight updates from the IDA Global Network, including announcements, member features, and regional highlights.",
    },
    contact: {
      title: "Contact | International Dyslexia Association",
      description: "Contact the IDA Global Network with membership, partnership, event, and general enquiries.",
    },
    login: {
      title: "Sign In | International Dyslexia Association",
      description: "Access your organization's member account through the IDA Global Network member portal.",
    },
  };

  const EVENT_TYPES = [
    {
      title: "Sip and Chat Sessions",
      copy: "Regular informal roundtables for members to share practice, challenges, and updates.",
      modifier: "chat",
    },
    {
      title: "Themed Practice Forums",
      copy: "Focused discussions around evidence-based practice, research, and systems approaches.",
      modifier: "forum",
    },
    {
      title: "Regional Conversations",
      copy: "Geographically focused sessions for members within the same region or language group.",
      modifier: "regional",
    },
    {
      title: "Member Spotlight Events",
      copy: "Showcasing member work, achievements, and initiatives across the Network.",
      modifier: "spotlight",
    },
    {
      title: "Strategy Discussions",
      copy: "International dialogue on the Network’s direction, priorities, and governance.",
      modifier: "strategy",
    },
    {
      title: "Conference-Linked Sessions",
      copy: "Annual caucus activities and showcase sessions at IDA’s international conference.",
      modifier: "conference",
    },
  ];

  const EVENTS_LIST = [
    {
      month: "Jul.",
      day: "17",
      title: "Global Network Sip and Chat — Advocacy & Awareness",
      summary: "A conversation for Network members focused on dyslexia awareness campaigns, public advocacy strategies, and what's working across different national contexts.",
      category: "Sip & Chat",
      categoryModifier: "chat",
      location: "Online",
      duration: "1 h",
      actionLabel: "Add to Calendar",
      image: "/assets/ida-home/audience-advocacy.png",
    },
    {
      month: "Aug.",
      day: "8",
      title: "Member Spotlight: Inclusive Assessment Models",
      summary: "Member organizations from three continents share their approaches to educational and psychological assessment for students with dyslexia.",
      category: "Spotlight",
      categoryModifier: "spotlight",
      location: "Online",
      duration: "90 min",
      actionLabel: "Add to Calendar",
      image: "/assets/ida-home/audience-assessment.png",
    },
    {
      month: "Sep.",
      day: "22",
      title: "International Strategy Session — Network Priorities 2025",
      summary: "An open discussion for Network members on strategic direction, collaborative project pipeline, and engagement priorities for the coming year.",
      category: "Strategy",
      categoryModifier: "strategy",
      location: "Online",
      duration: "2 h",
      actionLabel: "Add to Calendar",
      image: "/assets/ida-home/audience-policy.png",
    },
    {
      month: "Oct.",
      day: "4",
      title: "Regional Conversation — Arabic Language Access & Outreach",
      summary: "A region-focused exchange on strengthening community outreach, translation pathways, and culturally responsive member engagement.",
      category: "Regional",
      categoryModifier: "regional",
      location: "Hybrid",
      duration: "75 min",
      actionLabel: "Add to Calendar",
      image: "/assets/ida-home/audience-intervention.png",
    },
    {
      month: "Nov.",
      day: "13",
      title: "Practice Forum — Literacy Intervention in Multilingual Contexts",
      summary: "A practical forum exploring intervention models, implementation lessons, and classroom supports across multilingual learning environments.",
      category: "Practice Forum",
      categoryModifier: "forum",
      location: "Online",
      duration: "90 min",
      actionLabel: "Add to Calendar",
      image: "/assets/ida-home/audience-literacy.png",
    },
    {
      month: "Dec.",
      day: "5",
      title: "Conference-Linked Session — IDA Annual Meeting Preview",
      summary: "A pre-conference briefing highlighting featured conversations, shared visibility opportunities, and network touchpoints for participating members.",
      category: "Conference-linked",
      categoryModifier: "conference",
      location: "Chicago",
      duration: "1 h",
      actionLabel: "Add to Calendar",
      image: "/assets/ida-home/audience-training.png",
    },
  ];

  const EVENTS_FILTER_GROUPS = [
    {
      title: "All Categories",
      type: "category-stack",
      items: [
        { label: "Sip & Chat", modifier: "chat" },
        { label: "Spotlight", modifier: "spotlight" },
        { label: "Strategy", modifier: "strategy" },
        { label: "Regional", modifier: "regional" },
        { label: "Practice Forum", modifier: "forum" },
        { label: "Conference-linked", modifier: "conference" },
      ],
    },
    {
      title: "Location",
      type: "dropdown",
    },
    {
      title: "Price",
      type: "dropdown",
    },
  ];

  const OFFER_CARDS = [
    {
      modifier: "structured",
      title: "Structured Membership",
      titleHtml: "Structured<br>Membership",
      copy: "A clearer pathway for organizations to join, participate, and grow their engagement over time.",
    },
    {
      modifier: "digital",
      title: "Digital Connection",
      titleHtml: "Digital<br>Connection",
      copy: "A purpose-built platform designed to support membership, resources, events, communication, and reporting.",
    },
    {
      modifier: "collaborative",
      title: "Collaborative Opportunity",
      titleHtml: "Collaborative<br>Opportunity",
      copy: "A framework for projects, regional initiatives, and practical international partnerships.",
    },
    {
      modifier: "global",
      title: "Global Exchange",
      titleHtml: "Global<br>Exchange",
      copy: "Ongoing opportunities to share evidence-based practice, models, and ideas across countries and systems.",
    },
  ];

  const OFFER_ICON_LOTTIES = {
    structured: "/assets/ida-home/lottie/people.json?v=2",
    digital: "/assets/ida-home/lottie/digital-connection.json",
    collaborative: "/assets/ida-home/lottie/20.json",
    global: "/assets/ida-home/lottie/global-exchange.json",
  };
  const LOTTIE_SCRIPT_SRC = "https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.12.2/lottie.min.js";


  let lastPathname = "";
  let syncQueued = false;
  let destroyHero = null;
  let destroyAudienceSlider = null;
  let destroyMembershipKeywordBurst = null;
  let destroyBenefitsCarousel = null;
  let destroyDirectoryMap = null;

  function normalizePath(rawHref) {
    if (!rawHref) {
      return "";
    }

    const normalizedHref = String(rawHref).trim();

    if (
      !normalizedHref ||
      normalizedHref === "#" ||
      normalizedHref.startsWith("#") ||
      normalizedHref.toLowerCase().startsWith("javascript:") ||
      normalizedHref.toLowerCase().startsWith("mailto:") ||
      normalizedHref.toLowerCase().startsWith("tel:")
    ) {
      return "";
    }

    try {
      return new URL(normalizedHref, window.location.origin).pathname;
    } catch (error) {
      return normalizedHref;
    }
  }

  function normalizeComparablePath(rawPath) {
    const normalized = normalizePath(rawPath) || String(rawPath || "").trim() || "/";

    if (normalized === "/") {
      return "/";
    }

    return normalized.replace(/\/+$/, "");
  }

  function isMembershipPath(rawPath = window.location.pathname) {
    const comparablePath = normalizeComparablePath(rawPath);

    return comparablePath === "/membership" || comparablePath === "/membership.html";
  }

  function isGlobalNetworkApplicationPath(rawPath = window.location.pathname) {
    const comparablePath = normalizeComparablePath(rawPath);

    return comparablePath === "/membership/application" || comparablePath === "/membership/application.html";
  }

  function isDirectoryPath(rawPath = window.location.pathname) {
    const comparablePath = normalizeComparablePath(rawPath);

    return comparablePath === "/directory" || comparablePath === "/directory.html";
  }

  function isEventsPath(rawPath = window.location.pathname) {
    const comparablePath = normalizeComparablePath(rawPath);

    return comparablePath === "/events" || comparablePath === "/events.html";
  }

  function isCollaborativeProjectsPath(rawPath = window.location.pathname) {
    const comparablePath = normalizeComparablePath(rawPath);

    return comparablePath === "/collaborative-projects" || comparablePath === "/collaborative-projects.html";
  }

  function isProjectIdeaSubmissionPath(rawPath = window.location.pathname) {
    const comparablePath = normalizeComparablePath(rawPath);

    return (
      comparablePath === "/collaborative-projects/submit-a-project-idea"
      || comparablePath === "/collaborative-projects/submit-a-project-idea.html"
    );
  }

  function isNewsSpotlightPath(rawPath = window.location.pathname) {
    const comparablePath = normalizeComparablePath(rawPath);

    return comparablePath === "/news-and-global-spotlight" || comparablePath === "/news-and-global-spotlight.html";
  }

  function isContactPath(rawPath = window.location.pathname) {
    const comparablePath = normalizeComparablePath(rawPath);

    return comparablePath === "/contact" || comparablePath === "/contact.html";
  }

  function isLoginPath(rawPath = window.location.pathname) {
    const comparablePath = normalizeComparablePath(rawPath);

    return comparablePath === "/login" || comparablePath === "/login.html";
  }

  function isHomePath(rawHref) {
    if (!rawHref) {
      return false;
    }

    try {
      const resolvedUrl = new URL(String(rawHref).trim(), window.location.origin);
      return resolvedUrl.pathname === "/" && !resolvedUrl.search && !resolvedUrl.hash;
    } catch (error) {
      const comparablePath = normalizeComparablePath(rawHref);
      return comparablePath === "/" && String(rawHref).trim() === "/";
    }
  }

  function isKnownSpaPath(rawPath = window.location.pathname) {
    return (
      isHomePath(rawPath)
      || isMembershipPath(rawPath)
      || isGlobalNetworkApplicationPath(rawPath)
      || isDirectoryPath(rawPath)
      || isEventsPath(rawPath)
      || isCollaborativeProjectsPath(rawPath)
      || isProjectIdeaSubmissionPath(rawPath)
      || isNewsSpotlightPath(rawPath)
      || isContactPath(rawPath)
      || isLoginPath(rawPath)
    );
  }

  function pathMatchesCurrent(targetPath, currentPath = window.location.pathname) {
    const normalizedTarget = normalizeComparablePath(targetPath);
    const normalizedCurrent = normalizeComparablePath(currentPath);

    if (!normalizedTarget || normalizedTarget === "#") {
      return false;
    }

    if (isMembershipPath(normalizedTarget) && isMembershipPath(normalizedCurrent)) {
      return true;
    }

    if (isGlobalNetworkApplicationPath(normalizedTarget) && isGlobalNetworkApplicationPath(normalizedCurrent)) {
      return true;
    }

    if (isDirectoryPath(normalizedTarget) && isDirectoryPath(normalizedCurrent)) {
      return true;
    }

    if (isEventsPath(normalizedTarget) && isEventsPath(normalizedCurrent)) {
      return true;
    }

    if (isCollaborativeProjectsPath(normalizedTarget) && isCollaborativeProjectsPath(normalizedCurrent)) {
      return true;
    }

    if (isProjectIdeaSubmissionPath(normalizedTarget) && isProjectIdeaSubmissionPath(normalizedCurrent)) {
      return true;
    }

    if (isContactPath(normalizedTarget) && isContactPath(normalizedCurrent)) {
      return true;
    }

    if (isLoginPath(normalizedTarget) && isLoginPath(normalizedCurrent)) {
      return true;
    }

    if (normalizedTarget === "/") {
      return normalizedCurrent === "/";
    }

    return (
      normalizedCurrent === normalizedTarget ||
      normalizedCurrent.startsWith(`${normalizedTarget}/`)
    );
  }

  function syncCurrentMenuState(root) {
    if (!root) {
      return;
    }

    const currentPath = normalizeComparablePath(window.location.pathname) || "/";
    const items = Array.from(root.querySelectorAll(":scope > li"));

    items.forEach((item) => {
      item.classList.remove("is-current", "is-current-ancestor");
    });

    items.forEach((item) => {
      const directLink = Array.from(item.children).find((child) => child.tagName === "A");
      const directPath = normalizePath(directLink ? directLink.getAttribute("href") : "");
      const descendantPaths = Array.from(item.querySelectorAll("ul a"))
        .map((link) => normalizePath(link.getAttribute("href")))
        .filter(Boolean);

      const isCurrent = pathMatchesCurrent(directPath, currentPath);
      const hasCurrentDescendant = descendantPaths.some((path) => pathMatchesCurrent(path, currentPath));

      if (isCurrent) {
        item.classList.add("is-current");
      } else if (hasCurrentDescendant) {
        item.classList.add("is-current-ancestor");
      }
    });
  }

  function createNavLink(label, href) {
    const link = document.createElement("a");
    link.href = href;
    link.textContent = label;
    link.dataset.idaNavLabel = label;

    if (href && href !== "#") {
      link.dataset.idaSpaLink = "true";
    }

    return link;
  }

  function buildPrimaryNavItem(itemConfig) {
    const item = document.createElement("li");

    if (Array.isArray(itemConfig.children) && itemConfig.children.length) {
      item.classList.add("menu-item-has-children");
    }

    const link = createNavLink(itemConfig.label, itemConfig.href);

    if (Array.isArray(itemConfig.children) && itemConfig.children.length) {
      const chevron = document.createElement("span");
      chevron.className = "ida-nav-chevron";
      chevron.setAttribute("aria-hidden", "true");
      link.appendChild(chevron);

      const submenu = document.createElement("ul");
      submenu.className = "submenu";
      submenu.dataset.idaNavSubmenu = itemConfig.label;
      submenu.append(...itemConfig.children.map((childConfig) => buildPrimaryNavItem(childConfig)));
      item.appendChild(link);
      item.appendChild(submenu);
      return item;
    }

    item.appendChild(link);
    return item;
  }

  function getNavItemSignature(itemConfig) {
    return JSON.stringify({
      label: itemConfig.label,
      href: normalizePath(itemConfig.href),
      children: (itemConfig.children || []).map((child) => ({
        label: child.label,
        href: normalizePath(child.href),
      })),
    });
  }

  function primaryNavigationMatches(root) {
    const items = Array.from(root.children);

    if (items.length !== PRIMARY_NAV_ITEMS.length) {
      return false;
    }

    return PRIMARY_NAV_ITEMS.every((itemConfig, index) => {
      const item = items[index];
      return item && item.dataset.idaNavSignature === getNavItemSignature(itemConfig);
    });
  }

  function ensurePrimaryNavigation(root) {
    if (!root || primaryNavigationMatches(root)) {
      return;
    }

    const nodes = PRIMARY_NAV_ITEMS.map((itemConfig) => {
      const item = buildPrimaryNavItem(itemConfig);
      item.dataset.idaNavSignature = getNavItemSignature(itemConfig);
      return item;
    });

    root.replaceChildren(...nodes);
  }

  function ensureSharedNavigation() {
    const header = document.querySelector(".ch-header-area");
    const desktopMenu = header ? header.querySelector(".ch-menu") : null;
    const mobileMenu = document.querySelector(".mobile-menu .mobile-nav-menu, .mobile-menu .menu-outer > ul");

    ensurePrimaryNavigation(desktopMenu);
    ensurePrimaryNavigation(mobileMenu);
    syncCurrentMenuState(desktopMenu);
    syncCurrentMenuState(mobileMenu);
  }

  function hasHomepageMarkers() {
    return Boolean(
      document.querySelector(
        ".ch-newest-section, .ch-hero-section-2, .ch-supports-section, .ch-fea-section, .ch-contact-section"
      )
    );
  }

  function isHomepage() {
    return hasHomepageMarkers();
  }

  function buildHeroCopyMarkup() {
    return HERO_COPY_LINES
      .map((line) => `<span class="ida-network-copy-line">${line}</span>`)
      .join("");
  }

  function buildHeroVideoMarkup() {
    return `
      <div class="ida-network-circle">
        <video src="${HERO_VIDEO_SOURCE}" playsinline webkit-playsinline autoplay loop muted preload="auto" data-ida-hero-video></video>
      </div>`;
  }

  function getOfferIconMarkup(modifier) {
    const lottiePath = OFFER_ICON_LOTTIES[modifier];

    if (!lottiePath) {
      return "";
    }

    return `
      <div
        class="ida-offers-lottie ida-offers-lottie--${modifier}"
        data-ida-lottie="${lottiePath}"
        aria-hidden="true"
      ></div>`;
  }

  function buildOfferCardMarkup(card) {
    return `
      <article class="ida-offers-card ida-offers-card--${card.modifier}">
        <div class="ida-offers-card-head">
          <div class="ida-offers-card-icon">
            ${getOfferIconMarkup(card.modifier)}
          </div>
          <h3 class="ida-offers-card-title" aria-label="${card.title}">${card.titleHtml || card.title}</h3>
        </div>
        <div class="ida-offers-card-body">
          <p>${card.copy}</p>
        </div>
      </article>`;
  }

  function getAudienceItem(index) {
    return AUDIENCE_ITEMS[((index % AUDIENCE_ITEMS.length) + AUDIENCE_ITEMS.length) % AUDIENCE_ITEMS.length];
  }

  function buildAudienceCardMarkup(item, itemIndex, slot) {
    const slotClass = AUDIENCE_SLOT_CLASSES[String(slot)] || "";

    return `
      <article
        class="ida-audience-card ${slotClass}"
        data-ida-audience-card="${itemIndex}"
        data-ida-audience-index="${itemIndex}"
        data-ida-slot="${slot}"
        aria-hidden="${slot === 0 ? "false" : "true"}"
      >
        <figure class="ida-audience-card-figure">
          <img src="${item.src}" alt="${item.title}" loading="lazy">
        </figure>
        <h3 class="ida-audience-card-title">${item.title}</h3>
      </article>`;
  }

  function buildAudienceCardsMarkup(activeIndex = AUDIENCE_INITIAL_ACTIVE_INDEX) {
    return AUDIENCE_FRAME_SLOTS.map((slot) => {
      const itemIndex = ((activeIndex + slot) % AUDIENCE_ITEMS.length + AUDIENCE_ITEMS.length) % AUDIENCE_ITEMS.length;
      return buildAudienceCardMarkup(getAudienceItem(itemIndex), itemIndex, slot);
    }).join("");
  }

  function getFooterLogoSource() {
    const selectors = [
      ".ch-footer-section .footer-logo",
      "footer .footer-logo",
      ".ch-footer-section img[alt='footer-logo']",
      "footer img[alt='footer-logo']",
      ".ch-header-area .ch-header-logo-wrapper img",
      ".ch-header-area img.logo",
      "header .ch-header-logo-wrapper img",
      "header img.logo",
    ];

    for (const selector of selectors) {
      const image = document.querySelector(selector);

      if (!image) {
        continue;
      }

      const source = image.currentSrc || image.getAttribute("src");

      if (source) {
        return source;
      }
    }

    return FOOTER_LOGO_FALLBACK_SRC;
  }

  function getMembershipNavigationHref() {
    const membershipLink = document.querySelector(
      '.ch-header-area .ch-menu > li > a[href="/membership"], ' +
      '.ch-header-area .ch-menu > li > a[href="/membership.html"], ' +
      '.mobile-menu .mobile-nav-menu > li > a[href="/membership"], ' +
      '.mobile-menu .mobile-nav-menu > li > a[href="/membership.html"]'
    );

    return membershipLink ? (membershipLink.getAttribute("href") || MEMBERSHIP_PAGE_HREF) : MEMBERSHIP_PAGE_HREF;
  }

  function getDirectoryNavigationHref() {
    const directoryLink = document.querySelector(
      '.ch-header-area .ch-menu > li > a[href="/directory"], ' +
      '.ch-header-area .ch-menu > li > a[href="/directory.html"], ' +
      '.mobile-menu .mobile-nav-menu > li > a[href="/directory"], ' +
      '.mobile-menu .mobile-nav-menu > li > a[href="/directory.html"]'
    );

    return directoryLink ? (directoryLink.getAttribute("href") || DIRECTORY_PAGE_HREF) : DIRECTORY_PAGE_HREF;
  }

  function getEventsNavigationHref() {
    const eventsLink = document.querySelector(
      '.ch-header-area .ch-menu a[href="/events"], ' +
      '.ch-header-area .ch-menu a[href="/events.html"], ' +
      '.mobile-menu .mobile-nav-menu a[href="/events"], ' +
      '.mobile-menu .mobile-nav-menu a[href="/events.html"]'
    );

    return eventsLink ? (eventsLink.getAttribute("href") || EVENTS_PAGE_HREF) : EVENTS_PAGE_HREF;
  }

  function getCollaborativeProjectsNavigationHref() {
    const collaborativeProjectsLink = document.querySelector(
      '.ch-header-area .ch-menu a[href="/collaborative-projects"], ' +
      '.ch-header-area .ch-menu a[href="/collaborative-projects.html"], ' +
      '.mobile-menu .mobile-nav-menu a[href="/collaborative-projects"], ' +
      '.mobile-menu .mobile-nav-menu a[href="/collaborative-projects.html"]'
    );

    return collaborativeProjectsLink
      ? (collaborativeProjectsLink.getAttribute("href") || COLLABORATIVE_PROJECTS_PAGE_HREF)
      : COLLABORATIVE_PROJECTS_PAGE_HREF;
  }

  function getFooterLinkHref(label) {
    const directLinks = {
      Membership: getMembershipNavigationHref(),
      Directory: getDirectoryNavigationHref(),
      Events: getEventsNavigationHref(),
      "Collaborative Projects": getCollaborativeProjectsNavigationHref(),
      Projects: getCollaborativeProjectsNavigationHref(),
      "News & Spotlight": NEWS_SPOTLIGHT_PAGE_HREF,
      "Contact Us": CONTACT_PAGE_HREF,
      "Sign in": LOGIN_PAGE_HREF,
    };

    return directLinks[label] || "#";
  }

  function isPlainLeftClick(event) {
    return event.button === 0 && !event.metaKey && !event.ctrlKey && !event.shiftKey && !event.altKey;
  }

  function isSpaNavigableUrl(href) {
    if (!href || href === "#" || href.startsWith("mailto:") || href.startsWith("tel:")) {
      return false;
    }

    try {
      const url = new URL(href, window.location.origin);

      if (url.origin !== window.location.origin) {
        return false;
      }

      const currentPath = normalizeComparablePath(window.location.pathname);
      const targetPath = normalizeComparablePath(url.pathname);
      const currentSearch = window.location.search || "";
      const targetSearch = url.search || "";

      if (url.hash && targetPath === currentPath && targetSearch === currentSearch) {
        return false;
      }

      return isKnownSpaPath(url.pathname);
    } catch {
      return false;
    }
  }

  function navigateSpa(href) {
    const url = new URL(href, window.location.origin);
    const nextPath = `${url.pathname}${url.search}${url.hash}`;
    const currentPath = `${window.location.pathname}${window.location.search}${window.location.hash}`;

    if (nextPath === currentPath) {
      return;
    }

    history.pushState({}, "", nextPath);
    window.dispatchEvent(new PopStateEvent("popstate"));
    window.scrollTo(0, 0);
  }

  function handleSpaLinkClick(event) {
    const link = event.target.closest("a[href]");

    if (!link || !isPlainLeftClick(event) || event.defaultPrevented) {
      return;
    }

    if (link.dataset.idaSpaLink === "false" || link.hasAttribute("download")) {
      return;
    }

    if (link.target && link.target !== "_self") {
      return;
    }

    const href = link.getAttribute("href");

    if (!isSpaNavigableUrl(href)) {
      return;
    }

    event.preventDefault();
    navigateSpa(href);
  }

  function bindInertLink(link) {
    if (!link || link.dataset.idaInertLinkBound === "true") {
      return link;
    }

    link.dataset.idaInertLinkBound = "true";
    link.setAttribute("href", "#");
    link.removeAttribute("onclick");

    link.addEventListener("click", (event) => {
      event.preventDefault();
      event.stopPropagation();
      event.stopImmediatePropagation();
    });

    return link;
  }

  function buildFooterMarkup() {
    const currentYear = new Date().getFullYear();

    return `
      <section class="ida-footer-section" aria-labelledby="ida-footer-network">
        <div class="ida-footer-shell">
          <div class="ida-footer-grid">
            <div class="ida-footer-brand">
              <div class="ida-footer-brand-card">
                <img
                  class="ida-footer-brand-logo"
                  src="${getFooterLogoSource()}"
                  alt="International Dyslexia Association Global Network"
                  loading="lazy"
                >
              </div>
            </div>

            ${FOOTER_NAV_GROUPS.map((group, index) => `
              <nav
                class="ida-footer-nav"
                aria-labelledby="ida-footer-${group.title.toLowerCase()}"
              >
                <h2
                  class="ida-footer-nav-title"
                  id="ida-footer-${group.title.toLowerCase()}"
                >${group.title}</h2>
                <ul class="ida-footer-nav-list">
                  ${group.links.map((label) => `
                    <li>
                      <a class="ida-footer-link" data-ida-spa-link="true" href="${getFooterLinkHref(label)}">&gt;&gt; ${label}</a>
                    </li>`).join("")}
                </ul>
              </nav>`).join("")}
          </div>

          <div class="ida-footer-meta">
            <div class="ida-footer-divider" aria-hidden="true"></div>
            <p class="ida-footer-copyright">&copy; ${currentYear} International Dyslexia Association. All rights reserved.</p>
          </div>
        </div>
      </section>`;
  }

  function syncInjectedFooterLogo() {
    const source = getFooterLogoSource();

    document.querySelectorAll(".ida-footer-brand-logo").forEach((image) => {
      if (image.getAttribute("src") !== source) {
        image.setAttribute("src", source);
      }
    });
  }

  function syncInjectedFooterLinks() {
    document.querySelectorAll(".ida-footer-link").forEach((link) => {
      const label = link.textContent.replace(/^>>\s*/, "").trim();
      const href = getFooterLinkHref(label);

      if (href && link.getAttribute("href") !== href) {
        link.setAttribute("href", href);
      }
    });
  }

  function syncHeaderLogoLink() {
    document
      .querySelectorAll(".ch-header-area .ch-header-logo-wrapper, header .ch-header-logo-wrapper, a.ch-header-logo-wrapper")
      .forEach((link) => {
        if (link.getAttribute("href") !== HEADER_LOGO_EXTERNAL_HREF) {
          link.setAttribute("href", HEADER_LOGO_EXTERNAL_HREF);
        }

        if (link.getAttribute("target") !== "_blank") {
          link.setAttribute("target", "_blank");
        }

        if (link.getAttribute("rel") !== HEADER_LOGO_EXTERNAL_REL) {
          link.setAttribute("rel", HEADER_LOGO_EXTERNAL_REL);
        }
      });
  }

  function setMetaContent(selector, content) {
    if (!content) {
      return;
    }

    const element = document.querySelector(selector);

    if (element && element.getAttribute("content") !== content) {
      element.setAttribute("content", content);
    }
  }

  function syncRouteMeta(
    homepageActive,
    membershipActive,
    globalNetworkApplicationActive,
    directoryActive,
    eventsActive,
    collaborativeProjectsActive,
    projectIdeaSubmissionActive,
    newsSpotlightActive,
    contactActive,
    loginActive
  ) {
    const currentUrl = window.location.href;
    let routeMeta = ROUTE_META.default;

    if (membershipActive) {
      routeMeta = ROUTE_META.membership;
    } else if (globalNetworkApplicationActive) {
      routeMeta = ROUTE_META.globalNetworkApplication;
    } else if (directoryActive) {
      routeMeta = ROUTE_META.directory;
    } else if (eventsActive) {
      routeMeta = ROUTE_META.events;
    } else if (collaborativeProjectsActive) {
      routeMeta = ROUTE_META.collaborativeProjects;
    } else if (projectIdeaSubmissionActive) {
      routeMeta = ROUTE_META.projectIdeaSubmission;
    } else if (newsSpotlightActive) {
      routeMeta = ROUTE_META.newsSpotlight;
    } else if (contactActive) {
      routeMeta = ROUTE_META.contact;
    } else if (loginActive) {
      routeMeta = ROUTE_META.login;
    } else if (homepageActive || normalizeComparablePath(window.location.pathname) === "/") {
      routeMeta = ROUTE_META.home;
    }

    if (document.title !== routeMeta.title) {
      document.title = routeMeta.title;
    }

    setMetaContent('meta[name="title"]', routeMeta.title);
    setMetaContent('meta[name="description"]', routeMeta.description);
    setMetaContent('meta[property="og:title"]', routeMeta.title);
    setMetaContent('meta[property="og:description"]', routeMeta.description);
    setMetaContent('meta[property="twitter:title"]', routeMeta.title);
    setMetaContent('meta[property="twitter:description"]', routeMeta.description);
    setMetaContent('meta[property="og:url"]', currentUrl);
    setMetaContent('meta[property="twitter:url"]', currentUrl);
  }

  function homepageMarkup() {
    return `
      <div data-ida-homepage-sections>
        <section class="ida-network-hero">
          <div class="container-fluid">
            <div class="ida-network-layout">
              <div class="ida-network-content">
                <h1 class="ida-network-title">The <span>IDA</span> Global Network</h1>
                <div class="ida-network-points">
                  <div class="ida-network-copy">${buildHeroCopyMarkup()}</div>
                </div>
              </div>

              <div class="ida-network-visual" aria-hidden="true">
                ${buildHeroVideoMarkup()}
              </div>
            </div>
          </div>
        </section>

        <section class="ida-impact-section" id="ida-network-membership" data-ida-impact-section>
          <div class="ida-impact-shell">
            <div class="ida-impact-grid">
              <div class="ida-impact-media" aria-hidden="true">
                <div class="ida-impact-outline"></div>
                <div class="ida-impact-media-card ida-impact-media-card--wide">
                  <img src="/assets/ida-home/impact-tall.png" alt="" loading="lazy">
                </div>
                <div class="ida-impact-media-card ida-impact-media-card--tall">
                  <img src="/assets/ida-home/impact-wide.png" alt="" loading="lazy">
                </div>
                <div class="ida-impact-stats-shell">
                  <div class="ida-impact-stats-card">
                    <div class="ida-impact-stat-row">
                      <div class="ida-impact-stat-number">
                        <span class="ida-impact-stat-prefix">+</span><span data-count-to="15">15</span>
                      </div>
                      <div class="ida-impact-stat-text">Countries Engaged</div>
                    </div>
                    <div class="ida-impact-stat-row">
                      <div class="ida-impact-stat-number"><span data-count-to="3">3</span></div>
                      <div class="ida-impact-stat-text">Membership Tiers</div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="ida-impact-copy">
                <div class="ida-impact-kicker">
                  <span class="ida-impact-kicker-line"></span>
                  <span class="ida-impact-kicker-diamond"></span>
                  <span class="ida-impact-kicker-text">WHY THIS MATTERS?</span>
                </div>
                <h2 class="ida-impact-title">A Connected, Strategic Global Ecosystem</h2>
                <p>
                  Across countries and regions, organizations are working to improve awareness, research,
                  training, intervention, advocacy, and systems of support related to dyslexia and associated
                  learning difficulties.
                </p>
                <p>
                  The IDA Global Network exists to strengthen those efforts through clearer relationships,
                  stronger visibility, year-round engagement, and more meaningful international collaboration.
                </p>
              </div>
            </div>
          </div>
        </section>

        <section class="ida-offers-section" id="ida-network-offers">
          <div class="ida-offers-shell">
            <div class="ida-offers-top-row">
              <div class="ida-offers-heading">
                <h2 class="ida-offers-title">WHAT THE NETWORK OFFERS?</h2>
                <div class="ida-offers-accent">
                  <span class="ida-offers-accent-primary"></span>
                  <span class="ida-offers-accent-secondary"></span>
                </div>
              </div>
              ${buildOfferCardMarkup(OFFER_CARDS[0])}
            </div>
            <div class="ida-offers-bottom-row">
              ${OFFER_CARDS.slice(1).map(card => buildOfferCardMarkup(card)).join("")}
            </div>
          </div>
        </section>

        <section class="ida-audience-section" id="ida-network-directory">
          <div class="ida-audience-shell">
            <div class="ida-audience-copy-block">
              <h2 class="ida-audience-title">Who Is This For?</h2>
              <p class="ida-audience-copy">
                The Global Network is intended for organizations whose work aligns with IDA&apos;s mission and
                values, including<br><span class="ida-audience-copy-accent">organizations involved in:</span>
              </p>
            </div>

            <div class="ida-audience-stage" id="ida-network-governance">
              <div class="ida-audience-strip" aria-hidden="true"></div>
              <div class="ida-audience-track">
                ${buildAudienceCardsMarkup(AUDIENCE_INITIAL_ACTIVE_INDEX)}
              </div>
            </div>
          </div>
        </section>

        <section class="ida-goal-section">
          <div class="container-fluid ida-goal-shell">
            <div class="ida-goal-frame">
            <div class="ida-goal-grid">
            <div class="ida-goal-copy">
                <h2 class="ida-goal-title">The goal is not only to connect organizations,</h2>
                  <p>
                    but to create a stronger international structure<br>
                    through which they can participate, contribute,<br>
                    and grow in meaningful and visible ways.
                  </p>
                </div>
                <div class="ida-goal-visual" aria-hidden="true">
                  <img class="ida-goal-image" src="/assets/ida-home/members-network3.png" alt="" loading="lazy">
                </div>
              </div>
            </div>
          </div>
        </section>

        <section class="ida-cta-section" aria-labelledby="ida-cta-title">
          <div class="ida-cta-shell">
            <h2 class="ida-cta-title" id="ida-cta-title">Ready to explore membership or partnership?</h2>
            <p class="ida-cta-copy">
              <span class="ida-cta-copy-accent">Discover</span> how the Global Network can help your organization
              connect, contribute, and grow within a stronger international framework.
            </p>
            <div class="ida-cta-actions">
              <a class="ida-cta-button ida-cta-button--primary" href="/membership">Explore Membership</a>
              <a class="ida-cta-button ida-cta-button--secondary" href="/contact">Get In Touch</a>
            </div>
          </div>
        </section>

        ${buildFooterMarkup()}
      </div>`;
  }

  function buildMembershipSupportCardsMarkup() {
    return MEMBERSHIP_SUPPORT_CARDS.map((card) => `
      <article class="ida-membership-support-card">
        <span class="ida-membership-support-index">${card.index}</span>
        <h3 class="ida-membership-support-title">${card.title}</h3>
        <p class="ida-membership-support-copy">${card.copy}</p>
      </article>`).join("");
  }

  function buildMembershipTierMarkup() {
    return MEMBERSHIP_TIERS.map((tier) => `
      <article class="ida-membership-tier-card">
        <p class="ida-membership-tier-label">${tier.tier}</p>
        <h3 class="ida-membership-tier-title">${tier.title}</h3>
        <ul class="ida-membership-tier-list">
          ${tier.items.map((item) => `<li>${item}</li>`).join("")}
        </ul>
        <a class="ida-membership-tier-action" href="${GLOBAL_NETWORK_APPLICATION_PAGE_HREF}" data-ida-spa-link="true">Apply</a>
      </article>`).join("");
  }

  function buildMembershipKeywordMarkup() {
    return MEMBERSHIP_KEYWORDS.map((keyword, index) => `
      <span
        class="ida-membership-keyword ida-membership-keyword--${keyword.modifier}"
        data-ida-membership-keyword="${index}"
      >${keyword.label}</span>`).join("");
  }

  function membershipMarkup() {
    return `
      <div data-ida-membership-page>
        <section class="ida-membership-hero">
          <div class="ida-membership-hero-banner" aria-hidden="true">
            <img src="/assets/membership-connect.png" alt="" loading="eager">
          </div>
          <div class="ida-membership-hero-card">
            <h1 class="ida-membership-hero-title">Membership</h1>
            <p class="ida-membership-breadcrumb">Home &gt; Membership</p>
          </div>          
        </section>

        <section class="ida-membership-eligibility" data-ida-membership-eligibility>
          <div class="ida-membership-shell">
            <div class="ida-membership-accent-heading">
              <span class="ida-membership-accent-line" aria-hidden="true"></span>
              <span class="ida-membership-accent-diamond" aria-hidden="true"></span>
              <h2 class="ida-membership-kicker">WHO CAN APPLY ?</h2>
            </div>
            <div class="ida-membership-eligibility-stage">
              <p class="ida-membership-eligibility-text">
                Organizations if their work is aligned with supporting individuals with dyslexia and related
                learning difficulties <span>through:</span>
              </p>
              <div class="ida-membership-keyword-stage" aria-hidden="true">
                <div class="ida-membership-keyword-core"></div>
                ${buildMembershipKeywordMarkup()}
              </div>
            </div>
          </div>
        </section>

        <section class="ida-benefits-intro">
          <div class="ida-benefits-shell">
            <div class="ida-benefits-intro-heading">
              <span class="ida-benefits-intro-accent" aria-hidden="true">
                <span class="ida-benefits-intro-line"></span>
                <span class="ida-benefits-intro-diamond"></span>
              </span>
              <h2 class="ida-benefits-intro-title">Built for Real Value, Not Passive Affiliation</h2>
              <span class="ida-benefits-intro-accent" aria-hidden="true">
                <span class="ida-benefits-intro-diamond"></span>
                <span class="ida-benefits-intro-line"></span>
              </span>
            </div>
            <p class="ida-benefits-intro-text">
              Membership is intended to create real value for organizations while also strengthening
              the wider international mission of IDA.
            </p>
          </div>
        </section>

        <section class="ida-benefits-spotlight" data-ida-benefits-spotlight>
          <div class="ida-benefits-shell">
            <div class="ida-benefits-spotlight-grid">
              <div class="ida-benefits-spotlight-copy">
                <h2 class="ida-benefits-spotlight-title" data-ida-benefit-title>${BENEFITS_ITEMS[0].title}</h2>
                <p class="ida-benefits-spotlight-text" data-ida-benefit-copy>${BENEFITS_ITEMS[0].copy}</p>
              </div>
              <div class="ida-benefits-spotlight-stage" aria-hidden="true">
                ${buildBenefitsSpotlightStageMarkup()}
              </div>
            </div>
          </div>
        </section>

        <section class="ida-membership-tiers" id="ida-membership-tiers">
          <div class="ida-membership-shell">
            <div class="ida-membership-tier-grid">
              ${buildMembershipTierMarkup()}
            </div>
          </div>
        </section>

        <section class="ida-membership-supports">
          <div class="ida-membership-shell">
            <div class="ida-membership-supports-heading">
              <h2 class="ida-membership-supports-title">Membership Supports</h2>
              <div class="ida-membership-supports-accent" aria-hidden="true">
                <span class="ida-membership-supports-accent-primary"></span>
                <span class="ida-membership-supports-accent-secondary"></span>
              </div>
            </div>
            <div class="ida-membership-supports-grid">
              ${buildMembershipSupportCardsMarkup()}
            </div>
          </div>
        </section>

        ${buildFooterMarkup()}
      </div>`;
  }

  function getBenefitsGraphicMarkup(item) {
    const modifier = item?.modifier;
    const lottiePath = item?.lottiePath;

    if (!lottiePath) {
      return "";
    }

    return `
      <div
        class="ida-benefits-lottie ida-benefits-lottie--${modifier}"
        data-ida-lottie="${lottiePath}"
        aria-hidden="true"
      ></div>`;
  }

  function getBenefitCardPositionClass(offset) {
    if (offset <= 0) {
      return "ida-benefits-card--front";
    }

    if (offset === 1) {
      return "ida-benefits-card--mid";
    }

    return "ida-benefits-card--far";
  }

  function getBenefitItem(index) {
    return BENEFITS_ITEMS[((index % BENEFITS_ITEMS.length) + BENEFITS_ITEMS.length) % BENEFITS_ITEMS.length];
  }

  function buildBenefitsCardMarkup(item, offset) {
    return `
      <div
        class="ida-benefits-card ${getBenefitCardPositionClass(offset)}"
        data-ida-benefit-card
        data-ida-benefit-modifier="${item.modifier}"
      >
        <div
          class="ida-benefits-card-graphic ida-benefits-card-graphic--${item.modifier}"
          data-ida-benefit-graphic
        >
          ${getBenefitsGraphicMarkup(item)}
        </div>
      </div>`;
  }

  function buildBenefitsSpotlightStageMarkup() {
    const firstItem = BENEFITS_ITEMS[0];

    return `
      <div
        class="ida-benefits-card-stack"
        data-ida-benefit-card-stage
        data-ida-benefit-modifier="${firstItem.modifier}"
        aria-hidden="true"
      >
        ${Array.from({ length: BENEFITS_CARD_VISIBLE_COUNT }, (_, offset) =>
          buildBenefitsCardMarkup(getBenefitItem(offset), offset),
        ).join("")}
      </div>`;
  }

  function buildEventsTypeMarkup() {
    return EVENT_TYPES.map((item) => `
      <article class="ida-events-type-card ida-events-type-card--${item.modifier}">
        <div class="ida-events-type-icon" aria-hidden="true">
          ${getEventsTypeIconMarkup(item.modifier)}
        </div>
        <div class="ida-events-type-content">
          <h3 class="ida-events-type-title">${item.title}</h3>
          <p class="ida-events-type-copy">${item.copy}</p>
        </div>
      </article>`).join("");
  }

  function getEventsTypeIconMarkup(modifier) {
    if (modifier === "chat") {
      return `
        <svg viewBox="0 0 48 48" role="presentation" aria-hidden="true">
          <path d="M13 15.5h16a7 7 0 0 1 7 7v5.2a7 7 0 0 1-7 7H21l-6 4.8v-4.8h-2a7 7 0 0 1-7-7v-5.2a7 7 0 0 1 7-7Z" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linejoin="round"></path>
          <path d="M16.5 23h12M16.5 28h8.5" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"></path>
        </svg>`;
    }

    if (modifier === "forum") {
      return `
        <svg viewBox="0 0 48 48" role="presentation" aria-hidden="true">
          <rect x="12" y="12" width="7" height="7" rx="1.8" fill="none" stroke="currentColor" stroke-width="2.4"></rect>
          <rect x="20.5" y="12" width="7" height="7" rx="1.8" fill="none" stroke="currentColor" stroke-width="2.4"></rect>
          <rect x="29" y="12" width="7" height="7" rx="1.8" fill="none" stroke="currentColor" stroke-width="2.4"></rect>
          <rect x="12" y="20.5" width="7" height="7" rx="1.8" fill="none" stroke="currentColor" stroke-width="2.4"></rect>
          <rect x="20.5" y="20.5" width="7" height="7" rx="1.8" fill="none" stroke="currentColor" stroke-width="2.4"></rect>
          <rect x="29" y="20.5" width="7" height="7" rx="1.8" fill="none" stroke="currentColor" stroke-width="2.4"></rect>
          <rect x="12" y="29" width="7" height="7" rx="1.8" fill="none" stroke="currentColor" stroke-width="2.4"></rect>
          <rect x="20.5" y="29" width="7" height="7" rx="1.8" fill="none" stroke="currentColor" stroke-width="2.4"></rect>
          <rect x="29" y="29" width="7" height="7" rx="1.8" fill="none" stroke="currentColor" stroke-width="2.4"></rect>
        </svg>`;
    }

    if (modifier === "regional") {
      return `
        <svg viewBox="0 0 48 48" role="presentation" aria-hidden="true">
          <circle cx="24" cy="24" r="11.5" fill="none" stroke="currentColor" stroke-width="2.4"></circle>
          <path d="M12.5 24h23M24 12.5c3.5 3.7 5.3 7.5 5.3 11.5S27.5 31.8 24 35.5c-3.5-3.7-5.3-7.5-5.3-11.5S20.5 16.2 24 12.5Z" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"></path>
          <path d="M18.4 18.2c1.6.9 3.5 1.4 5.6 1.4s4-.5 5.6-1.4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
        </svg>`;
    }

    if (modifier === "spotlight") {
      return `
        <svg viewBox="0 0 48 48" role="presentation" aria-hidden="true">
          <path d="M24 11.5 33.2 15v9.8c0 5.5-3.7 10.2-9.2 11.7-5.5-1.5-9.2-6.2-9.2-11.7V15L24 11.5Z" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linejoin="round"></path>
          <path d="m20.6 23.7 2.3 2.5 4.7-5.5" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>`;
    }

    if (modifier === "strategy") {
      return `
        <svg viewBox="0 0 48 48" role="presentation" aria-hidden="true">
          <path d="M14 35V23M24 35V16M34 35V12" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"></path>
          <path d="M11.5 35h25" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"></path>
        </svg>`;
    }

    return `
      <svg viewBox="0 0 48 48" role="presentation" aria-hidden="true">
        <rect x="11" y="14" width="26" height="21" rx="5.2" fill="none" stroke="currentColor" stroke-width="2.4"></rect>
        <path d="M18 10.5v7M30 10.5v7M11 21h26M18 26.5h5M18 31h11" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"></path>
      </svg>`;
  }

  function getEventsMetaIconMarkup(kind) {
    if (kind === "location") {
      return `
        <svg viewBox="0 0 20 20" role="presentation" aria-hidden="true">
          <path d="M4.5 10a5.5 5.5 0 1 1 11 0c0 2.7-2.4 5.3-5.5 8-3.1-2.7-5.5-5.3-5.5-8Z" fill="none" stroke="currentColor" stroke-width="1.7"></path>
          <circle cx="10" cy="10" r="1.8" fill="currentColor"></circle>
        </svg>`;
    }

    return `
      <svg viewBox="0 0 20 20" role="presentation" aria-hidden="true">
        <circle cx="10" cy="10" r="7.2" fill="none" stroke="currentColor" stroke-width="1.7"></circle>
        <path d="M10 6.2V10l2.6 1.7" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"></path>
      </svg>`;
  }

  function buildEventsMetaPillMarkup(kind, value) {
    return `
      <span class="ida-events-card-meta-pill ida-events-card-meta-pill--${kind}">
        <span class="ida-events-card-meta-pill-icon" aria-hidden="true">
          ${getEventsMetaIconMarkup(kind)}
        </span>
        <span>${value}</span>
      </span>`;
  }

  function buildEventsListMarkup() {
    return EVENTS_LIST.map((eventItem, index) => `
      <article
        class="ida-events-card ida-events-card--${eventItem.categoryModifier}"
        style="--ida-events-card-image:url('${eventItem.image}')"
        data-ida-events-item
        ${index > 2 ? "hidden" : ""}
      >
        <div class="ida-events-card-date">
          <span class="ida-events-card-day">${eventItem.day}</span>
          <span class="ida-events-card-month">${eventItem.month}</span>
        </div>
        <div class="ida-events-card-body">
          <h3 class="ida-events-card-title">${eventItem.title}</h3>
          <p class="ida-events-card-summary">${eventItem.summary}</p>
          <div class="ida-events-card-meta">
            <span class="ida-events-chip ida-events-chip--${eventItem.categoryModifier}">${eventItem.category}</span>
            ${buildEventsMetaPillMarkup("location", eventItem.location)}
            ${buildEventsMetaPillMarkup("duration", eventItem.duration)}
            <button class="ida-events-card-calendar" type="button" aria-label="${eventItem.actionLabel} for ${eventItem.title}">
              <span class="ida-events-card-calendar-plus" aria-hidden="true">+</span>
              <span class="ida-events-card-calendar-label">${eventItem.actionLabel}</span>
            </button>
          </div>
        </div>
        <figure class="ida-events-card-figure" aria-hidden="true">
          <img src="${eventItem.image}" alt="${eventItem.title}" loading="lazy">
        </figure>
      </article>`).join("");
  }

  function getEventsFilterIconMarkup(type) {
    if (type === "category-stack") {
      return `
        <svg viewBox="0 0 24 24" role="presentation" aria-hidden="true">
          <rect x="3.5" y="3.5" width="7" height="7" rx="1.6" fill="none" stroke="currentColor" stroke-width="1.8"></rect>
          <rect x="13.5" y="3.5" width="7" height="7" rx="1.6" fill="none" stroke="currentColor" stroke-width="1.8"></rect>
          <rect x="3.5" y="13.5" width="7" height="7" rx="1.6" fill="none" stroke="currentColor" stroke-width="1.8"></rect>
          <rect x="13.5" y="13.5" width="7" height="7" rx="1.6" fill="none" stroke="currentColor" stroke-width="1.8"></rect>
        </svg>`;
    }

    if (type === "Location") {
      return `
        <svg viewBox="0 0 24 24" role="presentation" aria-hidden="true">
          <path d="M12 21c4.6-4.2 7-7.7 7-10.7a7 7 0 1 0-14 0c0 3 2.4 6.5 7 10.7Z" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linejoin="round"></path>
          <circle cx="12" cy="10.1" r="2.1" fill="currentColor"></circle>
        </svg>`;
    }

    if (type === "Gender") {
      return `
        <svg viewBox="0 0 24 24" role="presentation" aria-hidden="true">
          <circle cx="9" cy="9" r="4.4" fill="none" stroke="currentColor" stroke-width="1.8"></circle>
          <path d="M13.2 4.8h6v6M13.4 10.6l5.5-5.5M9 13.6V21M5.6 17.5h6.8" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>`;
    }

    return `
      <svg viewBox="0 0 24 24" role="presentation" aria-hidden="true">
        <path d="M3.5 8.3h11.8l4.5 3.8-4.5 3.8H3.5V8.3Z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"></path>
        <circle cx="8.4" cy="12.1" r="1.6" fill="none" stroke="currentColor" stroke-width="1.8"></circle>
      </svg>`;
  }

  function buildEventsFilterMarkup() {
    return EVENTS_FILTER_GROUPS.map((group) => `
      <section class="ida-events-filter-group ida-events-filter-group--${group.type}">
        ${group.type === "category-stack"
          ? `
            <button class="ida-events-filter-dropdown ida-events-filter-dropdown--stack" type="button" aria-expanded="true">
              <span class="ida-events-filter-dropdown-main">
                <span class="ida-events-filter-dropdown-icon" aria-hidden="true">
                  ${getEventsFilterIconMarkup(group.type)}
                </span>
                <span>${group.title}</span>
              </span>
              <span class="ida-events-filter-chevron" aria-hidden="true"></span>
            </button>
            <div class="ida-events-filter-stack">
              ${group.items.map((item) => `
                <span class="ida-events-filter-band ida-events-filter-band--${item.modifier}">
                  ${item.label}
                </span>`).join("")}
            </div>`
          : `
            <button class="ida-events-filter-dropdown" type="button" aria-expanded="false">
              <span class="ida-events-filter-dropdown-main">
                <span class="ida-events-filter-dropdown-icon" aria-hidden="true">
                  ${getEventsFilterIconMarkup(group.title)}
                </span>
                <span>${group.title}</span>
              </span>
              <span class="ida-events-filter-chevron" aria-hidden="true"></span>
            </button>`}
      </section>`).join("");
  }

  function buildEventsSectionHeadingMarkup(title, modifier = "") {
    return `
      <div class="ida-events-section-heading${modifier ? ` ${modifier}` : ""}">
        <span class="ida-events-heading-line" aria-hidden="true"></span>
        <h2 class="ida-events-section-title">${title}</h2>
        <span class="ida-events-heading-line" aria-hidden="true"></span>
      </div>`;
  }

  function eventsMarkup() {
    return `
      <div data-ida-events-page>
        <section class="ida-events-hero">
          <div class="ida-events-hero-banner">
            <img src="${EVENTS_HERO_IMAGE_SRC}" alt="" loading="eager">
            <div class="ida-events-hero-card">
              <h1 class="ida-events-hero-title">Events</h1>
              <p class="ida-events-breadcrumb">Home &gt; Events</p>
            </div>
          </div>
        </section>

        <section class="ida-events-intro-section">
          <div class="ida-events-shell">
            <div class="ida-events-intro-card">
              <p class="ida-events-intro">
                Sip and Chat sessions provide regular opportunities for members to <span>come together</span> around
                shared themes, emerging challenges, regional developments, and practical exchange.
              </p>
            </div>
          </div>
        </section>

        <section class="ida-events-types-section">
          <div class="ida-events-shell">
            ${buildEventsSectionHeadingMarkup("Events Types")}
            <div class="ida-events-types-grid">
              ${buildEventsTypeMarkup()}
            </div>
          </div>
        </section>

        <section class="ida-events-calendar-section">
          <div class="ida-events-shell">
            ${buildEventsSectionHeadingMarkup("Mark Your Calendar", "ida-events-section-heading--calendar")}
            <div class="ida-events-calendar-grid">
              <div class="ida-events-list-wrap">
                <div class="ida-events-list">
                  ${buildEventsListMarkup()}
                </div>
                <div class="ida-events-more">
                  <button class="ida-events-more-button" type="button" data-ida-events-more>Show More</button>
                </div>
              </div>
              <aside class="ida-events-filters">
                <button class="ida-events-clear-filters" type="button">Clear all filters</button>
                ${buildEventsFilterMarkup()}
              </aside>
            </div>
          </div>
        </section>

        <section class="ida-events-cta-section">
          <div class="ida-events-shell">
            <div class="ida-events-cta-card">
              <span class="ida-events-cta-orb ida-events-cta-orb--left" aria-hidden="true"></span>
              <span class="ida-events-cta-orb ida-events-cta-orb--right" aria-hidden="true"></span>
              <div class="ida-events-cta-copy">
                <p class="ida-events-cta-text">
                  <strong>The Global Network</strong> is intended to be a <strong>year-round</strong> engagement ecosystem. Events are not
                  treated as isolated moments, but as part of a broader rhythm of ongoing exchange,
                  collaboration, and visibility.
                </p>
              </div>
              <div class="ida-events-cta-actions">
                <a class="ida-events-cta-button ida-events-cta-button--primary" href="${EVENTS_PAGE_HREF}">View Upcoming Events</a>
                <a class="ida-events-cta-button ida-events-cta-button--secondary" href="#">Register for a session</a>
              </div>
            </div>
          </div>
        </section>

        ${buildFooterMarkup()}
      </div>`;
  }

  function collaborativeProjectsMarkup() {
    const collaborativeWorkItems = [
      {
        icon: "exchange",
        title: "International Exchange",
        copy: "Cross-country and regional exchange initiatives between member organizations.",
      },
      {
        icon: "knowledge",
        title: "Knowledge Sharing",
        copy: "Partnerships built around sharing evidence-based practice and models across systems.",
      },
      {
        icon: "capacity",
        title: "Capacity Building",
        copy: "Activities designed to strengthen organizational capacity and professional expertise.",
      },
      {
        icon: "groups",
        title: "Working Groups",
        copy: "Themed working groups convening organizations around shared challenges and interests.",
      },
      {
        icon: "pilot",
        title: "Pilot Collaborations",
        copy: "Smaller, time-limited pilot projects allowing practical international exchange.",
      },
      {
        icon: "sustainability",
        title: "Sustainability Initiatives",
        copy: "Fundraising and sustainability projects strengthening the Network&apos;s long-term impact.",
      },
    ];

    const getCollaborativeWorkIconMarkup = (icon) => {
      if (icon === "exchange") {
        return `
          <svg viewBox="0 0 24 24" role="presentation" aria-hidden="true">
            <path d="M12 21c4.6-4.2 7-7.7 7-10.7a7 7 0 1 0-14 0c0 3 2.4 6.5 7 10.7Z" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linejoin="round"></path>
            <circle cx="12" cy="10.1" r="2.1" fill="currentColor"></circle>
          </svg>`;
      }

      if (icon === "knowledge") {
        return `
          <svg viewBox="0 0 24 24" role="presentation" aria-hidden="true">
            <path d="M5 6.6c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2v10.8c0 .5-.4.9-.9.9H8.5c-1.9 0-3.5 1.6-3.5 3.5V6.6Z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"></path>
            <path d="M8.5 18.2h9.6M8.6 8.6h6.8M8.6 11.7h6.8" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"></path>
          </svg>`;
      }

      if (icon === "capacity") {
        return `
          <svg viewBox="0 0 24 24" role="presentation" aria-hidden="true">
            <circle cx="7" cy="6.8" r="2.2" fill="none" stroke="currentColor" stroke-width="1.8"></circle>
            <circle cx="17.2" cy="6.8" r="2.2" fill="none" stroke="currentColor" stroke-width="1.8"></circle>
            <circle cx="12.1" cy="17.1" r="2.2" fill="none" stroke="currentColor" stroke-width="1.8"></circle>
            <path d="M8.8 8.1 10.7 12M15.4 8.1 13.4 12M9.7 15.3h4.8" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"></path>
          </svg>`;
      }

      if (icon === "groups") {
        return `
          <svg viewBox="0 0 24 24" role="presentation" aria-hidden="true">
            <circle cx="8" cy="9" r="2.4" fill="none" stroke="currentColor" stroke-width="1.8"></circle>
            <circle cx="16" cy="9" r="2.4" fill="none" stroke="currentColor" stroke-width="1.8"></circle>
            <path d="M4.9 17.8c.7-2.3 2.4-3.7 4.8-3.7s4.1 1.4 4.8 3.7M13.4 17.8c.5-1.6 1.9-2.7 3.8-2.7 1.1 0 2 .3 2.8.9.5.4.9 1 1.1 1.8" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"></path>
          </svg>`;
      }

      if (icon === "pilot") {
        return `
          <svg viewBox="0 0 24 24" role="presentation" aria-hidden="true">
            <rect x="4.4" y="5.2" width="15.2" height="13.6" rx="2.3" fill="none" stroke="currentColor" stroke-width="1.8"></rect>
            <path d="m8.2 12.2 2.2 2.3 5.5-5.5" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"></path>
          </svg>`;
      }

      return `
        <svg viewBox="0 0 24 24" role="presentation" aria-hidden="true">
          <path d="M12 3.8v16.4M7.2 7.2c0-1.6 1.3-2.8 2.8-2.8H14c1.7 0 3.1 1.4 3.1 3.1 0 1.5-1.1 2.7-2.5 3l-5.2 1.1c-1.4.3-2.4 1.5-2.4 2.9 0 1.7 1.4 3.1 3.1 3.1H14c1.6 0 2.8-1.3 2.8-2.8" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>`;
    };

    const collaborativeWorkCardsMarkup = collaborativeWorkItems.map((item) => `
      <article class="ida-collaborative-work-card">
        <span class="ida-collaborative-work-icon" aria-hidden="true">
          ${getCollaborativeWorkIconMarkup(item.icon)}
        </span>
        <h3 class="ida-collaborative-work-card-title">${item.title}</h3>
        <p class="ida-collaborative-work-card-copy">${item.copy}</p>
      </article>`).join("");

    return `
      <div data-ida-collaborative-projects-page>
        <section class="ida-collaborative-hero">
          <div class="ida-collaborative-hero-banner">
            <img src="${COLLABORATIVE_PROJECTS_HERO_IMAGE_SRC}" alt="" loading="eager">
            <div class="ida-collaborative-hero-card">
              <h1 class="ida-collaborative-hero-title">Collaborative Projects</h1>
              <p class="ida-collaborative-breadcrumb">Home &gt; Collaborative Projects</p>
            </div>
          </div>
        </section>

        <section class="ida-collaborative-intro-section">
          <div class="ida-collaborative-shell">
            <div class="ida-collaborative-intro-card">
              <p class="ida-collaborative-intro">
                Collaborative projects allow the Network to move from conversation to practical action. They can support
                cross-country exchange, regional problem-solving, shared learning, and strategic initiatives aligned with
                IDA&apos;s mission.
              </p>
            </div>
          </div>
        </section>

        <section class="ida-collaborative-work-section">
          <div class="ida-collaborative-shell">
            <div class="ida-collaborative-section-heading">
              <h2 class="ida-collaborative-section-title">Areas of Collaborative Work</h2>
              <span class="ida-collaborative-section-accent" aria-hidden="true"></span>
            </div>
            <div class="ida-collaborative-work-grid">
              ${collaborativeWorkCardsMarkup}
              <aside class="ida-collaborative-work-cta" aria-label="Project idea call to action">
                <h3 class="ida-collaborative-work-cta-title">Have a project idea?</h3>
                <p class="ida-collaborative-work-cta-copy">
                  The Network welcomes practical ideas for cross-country exchange and international collaboration.
                  Submit an outline to begin the conversation.
                </p>
                <div class="ida-collaborative-work-cta-actions">
                  <a
                    class="ida-collaborative-work-cta-button ida-collaborative-work-cta-button--primary ida-route-hover-control"
                    href="${PROJECT_IDEA_SUBMISSION_PAGE_HREF}"
                    data-ida-spa-link="true"
                    data-ida-hover-mode="filled"
                    style="--ida-route-hover-border: rgb(10, 145, 156); --ida-route-hover-text: rgb(10, 145, 156);"
                  >Submit a Project Idea</a>
                  <button class="ida-collaborative-work-cta-button ida-collaborative-work-cta-button--secondary" type="button">Learn About Current Initiatives</button>
                </div>
              </aside>
            </div>
          </div>
        </section>

        ${buildFooterMarkup()}
      </div>`;
  }

  function projectIdeaSubmissionMarkup() {
    return `
      <div data-ida-project-idea-page>
        <section class="ida-collaborative-hero ida-route-reveal-target is-visible">
          <div class="ida-collaborative-hero-banner ida-project-idea-hero-banner">
            <img
              src="${PROJECT_IDEA_SUBMISSION_HERO_IMAGE_SRC}"
              alt="IDA Global Network members collaborating around a table"
              loading="eager"
              onerror="this.style.backgroundImage='url(/assets/collaborative-projects/hero.jpg)'; this.removeAttribute('srcset');"
            >
            <div class="ida-collaborative-hero-card ida-project-idea-hero-card">
              <h1 class="ida-collaborative-hero-title">Project Idea Submission</h1>
              <p class="ida-collaborative-breadcrumb ida-project-idea-breadcrumb">Home &gt; Collaborative Projects &gt; Project Idea Submission</p>
            </div>
          </div>
        </section>

        <section class="ida-project-idea-intro-section ida-route-reveal-target is-visible">
          <div class="ida-collaborative-shell">
            <div class="ida-project-idea-intro-card">
              <p class="ida-project-idea-intro">
                Submitting a project idea is one of the benefits of official IDA Global Network membership. This form allows
                Partner and Contributor organizations to propose project ideas for consideration by the Global Network Committee.
              </p>
              <p class="ida-project-idea-note">
                Approved projects may be led by IDA in pursuit of third-party funding, but IDA does not directly fund submitted projects.
                Submission of this form does not guarantee project approval or funding.
              </p>
            </div>
          </div>
        </section>

        <section class="ida-project-idea-form-section ida-route-reveal-target is-visible">
          <div class="ida-collaborative-shell">
            <div class="ida-collaborative-section-heading">
              <h2 class="ida-collaborative-section-title">IDA Global Network Project Idea Submission Form</h2>
              <span class="ida-collaborative-section-accent" aria-hidden="true"></span>
            </div>

            <form class="ida-project-idea-form" novalidate>
              <section class="ida-project-idea-form-card" aria-labelledby="ida-project-idea-section-1">
                <div class="ida-project-idea-form-card-header">
                  <p class="ida-project-idea-form-step">Section 1</p>
                  <h3 class="ida-project-idea-form-card-title" id="ida-project-idea-section-1">Submitter Information</h3>
                </div>
                <div class="ida-project-idea-form-grid ida-project-idea-form-grid--two">
                  <label class="ida-project-idea-field">
                    <span class="ida-project-idea-label">Global Network Organization Name</span>
                    <input class="ida-project-idea-input" type="text" name="organization_name">
                  </label>

                  <fieldset class="ida-project-idea-field ida-project-idea-fieldset">
                    <legend class="ida-project-idea-label">Membership Level</legend>
                    <div class="ida-project-idea-choice-grid">
                      <label class="ida-project-idea-choice">
                        <input type="checkbox" name="membership_level_partner">
                        <span>Partner</span>
                      </label>
                      <label class="ida-project-idea-choice">
                        <input type="checkbox" name="membership_level_contributor">
                        <span>Contributor</span>
                      </label>
                    </div>
                  </fieldset>

                  <label class="ida-project-idea-field">
                    <span class="ida-project-idea-label">Representative Name</span>
                    <input class="ida-project-idea-input" type="text" name="representative_name">
                  </label>

                  <label class="ida-project-idea-field">
                    <span class="ida-project-idea-label">Position / Title</span>
                    <input class="ida-project-idea-input" type="text" name="position_title">
                  </label>

                  <label class="ida-project-idea-field">
                    <span class="ida-project-idea-label">Email Address</span>
                    <input class="ida-project-idea-input" type="email" name="email_address">
                  </label>

                  <label class="ida-project-idea-field">
                    <span class="ida-project-idea-label">Phone Number</span>
                    <input class="ida-project-idea-input" type="tel" name="phone_number">
                  </label>
                </div>
              </section>

              <section class="ida-project-idea-form-card" aria-labelledby="ida-project-idea-section-2">
                <div class="ida-project-idea-form-card-header">
                  <p class="ida-project-idea-form-step">Section 2</p>
                  <h3 class="ida-project-idea-form-card-title" id="ida-project-idea-section-2">Project Idea</h3>
                </div>
                <div class="ida-project-idea-form-grid">
                  <label class="ida-project-idea-field">
                    <span class="ida-project-idea-label">Project Title</span>
                    <input class="ida-project-idea-input" type="text" name="project_title">
                  </label>

                  <label class="ida-project-idea-field">
                    <span class="ida-project-idea-label">Project Objective</span>
                    <span class="ida-project-idea-help">What problem does this project address, and for whom?</span>
                    <textarea class="ida-project-idea-input ida-project-idea-input--textarea" name="project_objective" rows="5"></textarea>
                  </label>

                  <label class="ida-project-idea-field">
                    <span class="ida-project-idea-label">Project Scope</span>
                    <span class="ida-project-idea-help">Outline the key activities and deliverables.</span>
                    <textarea class="ida-project-idea-input ida-project-idea-input--textarea" name="project_scope" rows="5"></textarea>
                  </label>

                  <label class="ida-project-idea-field">
                    <span class="ida-project-idea-label">Proposed Timeline</span>
                    <span class="ida-project-idea-help">Provide a proposed start date, end date, and any key milestones.</span>
                    <textarea class="ida-project-idea-input ida-project-idea-input--textarea" name="proposed_timeline" rows="4"></textarea>
                  </label>

                  <label class="ida-project-idea-field">
                    <span class="ida-project-idea-label">Target Audience &amp; Expected Outcomes</span>
                    <span class="ida-project-idea-help">Describe who will benefit and the anticipated impact.</span>
                    <textarea class="ida-project-idea-input ida-project-idea-input--textarea" name="target_audience_outcomes" rows="5"></textarea>
                  </label>

                  <label class="ida-project-idea-field">
                    <span class="ida-project-idea-label">Alignment with IDA&apos;s Mission</span>
                    <span class="ida-project-idea-help">Explain how this project supports IDA&apos;s sharpened vision: “Structured Literacy in every Kindergarten through 5th grade classroom and around the world.”</span>
                    <textarea class="ida-project-idea-input ida-project-idea-input--textarea" name="mission_alignment" rows="5"></textarea>
                  </label>
                </div>
              </section>

              <section class="ida-project-idea-form-card" aria-labelledby="ida-project-idea-section-3">
                <div class="ida-project-idea-form-card-header">
                  <p class="ida-project-idea-form-step">Section 3</p>
                  <h3 class="ida-project-idea-form-card-title" id="ida-project-idea-section-3">Funding</h3>
                </div>
                <div class="ida-project-idea-form-grid">
                  <label class="ida-project-idea-field">
                    <span class="ida-project-idea-label">Estimated Budget / Resources Needed</span>
                    <textarea class="ida-project-idea-input ida-project-idea-input--textarea" name="estimated_budget" rows="4"></textarea>
                  </label>

                  <label class="ida-project-idea-field">
                    <span class="ida-project-idea-label">Proposed Third-Party Funder(s), if any already identified</span>
                    <span class="ida-project-idea-help">e.g. foundation, corporate sponsor, government grant program</span>
                    <textarea class="ida-project-idea-input ida-project-idea-input--textarea" name="third_party_funders" rows="4"></textarea>
                  </label>

                  <fieldset class="ida-project-idea-field ida-project-idea-fieldset">
                    <legend class="ida-project-idea-label">Requested Role for IDA in Pursuing Funding</legend>
                    <div class="ida-project-idea-choice-grid ida-project-idea-choice-grid--stacked">
                      <label class="ida-project-idea-choice">
                        <input type="checkbox" name="ida_role_cobranding">
                        <span>Co-branding / endorsement</span>
                      </label>
                      <label class="ida-project-idea-choice">
                        <input type="checkbox" name="ida_role_introductions">
                        <span>Introductions to funders</span>
                      </label>
                      <label class="ida-project-idea-choice">
                        <input type="checkbox" name="ida_role_letter_support">
                        <span>Letter of support</span>
                      </label>
                      <label class="ida-project-idea-choice">
                        <input type="checkbox" name="ida_role_joint_application">
                        <span>Joint grant application</span>
                      </label>
                      <label class="ida-project-idea-choice">
                        <input type="checkbox" name="ida_role_other">
                        <span>Other</span>
                      </label>
                    </div>
                  </fieldset>

                  <label class="ida-project-idea-field">
                    <span class="ida-project-idea-label">Other / Additional Details</span>
                    <textarea class="ida-project-idea-input ida-project-idea-input--textarea" name="additional_details" rows="4"></textarea>
                  </label>
                </div>
                <p class="ida-project-idea-inline-note">
                  Please note: IDA Global Network may lead or support the effort to secure third-party funding for approved projects, but does not provide direct funding itself.
                </p>
              </section>

              <section class="ida-project-idea-form-card" aria-labelledby="ida-project-idea-section-4">
                <div class="ida-project-idea-form-card-header">
                  <p class="ida-project-idea-form-step">Section 4</p>
                  <h3 class="ida-project-idea-form-card-title" id="ida-project-idea-section-4">Acknowledgment</h3>
                </div>
                <div class="ida-project-idea-form-grid">
                  <fieldset class="ida-project-idea-field ida-project-idea-fieldset">
                    <legend class="ida-project-idea-label">Please confirm the following</legend>
                    <div class="ida-project-idea-choice-grid ida-project-idea-choice-grid--stacked">
                      <label class="ida-project-idea-choice">
                        <input type="checkbox" name="acknowledge_good_standing">
                        <span>I confirm my organization is a current IDA Global Network member (Partner or Contributor) in good standing.</span>
                      </label>
                      <label class="ida-project-idea-choice">
                        <input type="checkbox" name="acknowledge_no_guarantee">
                        <span>I understand that submission of this form does not guarantee project approval or funding.</span>
                      </label>
                      <label class="ida-project-idea-choice">
                        <input type="checkbox" name="acknowledge_committee_review">
                        <span>I understand this proposal will be reviewed by the Global Network Committee, using IDA&apos;s internal scoring criteria, prior to any next steps.</span>
                      </label>
                    </div>
                  </fieldset>                  
                </div>
              </section>

              <div class="ida-project-idea-form-actions">
                <button class="ida-collaborative-work-cta-button ida-collaborative-work-cta-button--primary ida-route-hover-control" type="button" data-ida-hover-mode="filled" style="--ida-route-hover-border: rgb(10, 145, 156); --ida-route-hover-text: rgb(10, 145, 156);">Submit Project Idea</button>
                <button class="ida-collaborative-work-cta-button ida-collaborative-work-cta-button--secondary ida-route-hover-control" type="reset" data-ida-hover-mode="outlined" style="--ida-route-hover-background: rgb(10, 145, 156); --ida-route-hover-text: rgb(255, 255, 255);">Reset Form</button>
              </div>
            </form>
          </div>
        </section>

        ${buildFooterMarkup()}
      </div>`;
  }

  function buildGlobalNetworkApplicationStepMarkup() {
    const steps = [
      "Contact",
      "Organization",
      "Members",
      "Mission & Practice",
      "Documents",
      "Review",
    ];

    return steps.map((step, index) => `
      <button type="button" class="ida-gn-application-step" data-ida-application-step-target="${index + 1}" aria-current="false">
        <span class="ida-gn-application-step-number">${index + 1}</span>
        <span>${step}</span>
      </button>`).join("");
  }

  function buildGlobalNetworkApplicationOptionMarkup(options) {
    return options.map((option) => `<option value="${option}">${option}</option>`).join("");
  }

  function buildGlobalNetworkApplicationYesNoFieldsets(fields, fullWidthNames = []) {
    return fields.map(({ name, label }) => `
      <fieldset class="ida-gn-application-field ${fullWidthNames.includes(name) ? "ida-gn-application-field--full" : ""}">
        <legend class="ida-gn-application-label">${label}</legend>
        <div class="ida-gn-application-choice-row">
          <label class="ida-gn-application-choice">
            <input type="radio" name="${name}" value="yes">
            <span>Yes</span>
          </label>
          <label class="ida-gn-application-choice">
            <input type="radio" name="${name}" value="no">
            <span>No</span>
          </label>
        </div>
      </fieldset>`).join("");
  }

  function globalNetworkApplicationMarkup() {
    const countryOptions = [
      "Egypt",
      "Kuwait",
      "Saudi Arabia",
      "United Arab Emirates",
      "United Kingdom",
      "United States",
      "Other",
    ];
    const organizationStructureOptions = ["NGO", "Non-profit", "Charity", "Other"];
    const organizationYesNoFields = [
      { name: "has_nonprofit_status", label: "Do you have NGO, non-profit, or charity status?" },
      { name: "has_formal_bylaws", label: "Does your association have formal bylaws?" },
      { name: "has_annual_report", label: "Do you produce an annual operating or financial report?" },
      { name: "receives_government_funding", label: "Do you receive government or state funding?" },
      { name: "is_ida_member", label: "Is your organization a member of IDA?" },
    ];
    const memberYesNoFields = [
      { name: "is_membership_organization", label: "Are you a membership organization?" },
      { name: "has_recruitment_material", label: "Do you print promotional or member recruitment material?" },
      { name: "supports_branches_or_chapters", label: "Does your organization support local branches or chapters?" },
    ];
    const missionYesNoFields = [
      { name: "offers_public_activities", label: "Do you offer public activities to the community?" },
      { name: "has_annual_conference", label: "Do you have an annual conference?" },
      { name: "supports_country_definition", label: "Does your organization support this definition?" },
      { name: "supports_instructional_approaches", label: "Does your organization support these approaches and programs?" },
    ];

    return `
      <div data-ida-global-network-application-page>
        <section class="ida-gn-application-hero ida-route-reveal-target is-visible">
          <div class="ida-gn-application-hero-banner">
            <img src="${GLOBAL_NETWORK_APPLICATION_HERO_IMAGE_SRC}" alt="" loading="eager">
            <div class="ida-gn-application-hero-card">
              <h1 class="ida-gn-application-hero-title">Global Network Application</h1>
              <p class="ida-gn-application-breadcrumb">Home &gt; Membership &gt; Global Network Application</p>
            </div>
          </div>
        </section>

        <section class="ida-gn-application-intro-section ida-route-reveal-target is-visible">
          <div class="ida-gn-application-shell">
            <div class="ida-gn-application-intro-card">
              <p class="ida-gn-application-kicker">Multi-step application preview</p>
              <h2 class="ida-gn-application-intro-title">A guided application flow styled to match the IDA Global Network website</h2>
              <p class="ida-gn-application-intro-copy">
                This is a front-end version of the Global Network application. It follows the same structure as the working GN application prototype, but for now it runs without validation, saving, or backend submission.
              </p>
            </div>
          </div>
        </section>

        <section class="ida-gn-application-form-section ida-route-reveal-target is-visible">
          <div class="ida-gn-application-shell">
            <div class="ida-collaborative-section-heading ida-gn-application-section-heading">
              <h2 class="ida-collaborative-section-title">IDA Global Network Application Form</h2>
              <span class="ida-collaborative-section-accent" aria-hidden="true"></span>
            </div>

            <form class="ida-gn-application-layout is-welcome-step" data-ida-application-form novalidate>
              <aside class="ida-gn-application-stepper" aria-label="Application sections">
                ${buildGlobalNetworkApplicationStepMarkup()}
              </aside>

              <div class="ida-gn-application-card">
                <div class="ida-gn-application-progress" aria-live="polite">
                  <div class="ida-gn-application-progress-row">
                    <span class="ida-gn-application-progress-label" data-ida-application-progress-step>Step 1 of 6</span>
                    <strong data-ida-application-progress-percent>17% complete</strong>
                  </div>
                  <div class="ida-gn-application-progress-track" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="17" data-ida-application-progress-bar>
                    <span style="width: 17%"></span>
                  </div>
                  <p class="ida-gn-application-progress-help">The step flow is active now. Validation, draft saving, and backend submission will be connected later.</p>
                </div>

                <section class="ida-gn-application-panel ida-gn-application-panel--welcome is-active" data-ida-application-panel="0">
                  <p class="ida-gn-application-kicker">Welcome</p>
                  <h3 class="ida-gn-application-panel-title">Welcome to IDA Global Network Central</h3>
                  <p class="ida-gn-application-welcome-copy">
                    IDA Global Network Central is the online home of the International Dyslexia Association&apos;s Global Network. Through this platform, prospective and current members can apply for membership, connect with colleagues worldwide, share initiatives, access resources, participate in collaborative projects, and contribute to the advancement of dyslexia advocacy and evidence-based practice.
                  </p>
                  <p class="ida-gn-application-welcome-note">
                    We are pleased to welcome you to a growing international community working together to create meaningful impact across diverse regions and cultures.
                  </p>
                </section>

                <section class="ida-gn-application-panel" data-ida-application-panel="1">
                  <h3 class="ida-gn-application-panel-title">Association contact information</h3>
                  <p class="ida-gn-application-panel-note">Tell the IDA Home Office who is applying and who should be contacted about this application.</p>
                  <div class="ida-gn-application-grid">
                    <label class="ida-gn-application-field">
                      <span class="ida-gn-application-label">Organization name</span>
                      <input class="ida-gn-application-input" name="organization_name" type="text">
                    </label>
                    <label class="ida-gn-application-field">
                      <span class="ida-gn-application-label">Acronym</span>
                      <input class="ida-gn-application-input" name="acronym" type="text">
                    </label>
                    <label class="ida-gn-application-field">
                      <span class="ida-gn-application-label">Contact name</span>
                      <input class="ida-gn-application-input" name="contact_name" type="text">
                      <p class="ida-gn-application-help">The person completing this application.</p>
                    </label>
                    <label class="ida-gn-application-field">
                      <span class="ida-gn-application-label">Contact position</span>
                      <input class="ida-gn-application-input" name="contact_position" type="text">
                    </label>
                    <label class="ida-gn-application-field">
                      <span class="ida-gn-application-label">Primary contact name</span>
                      <input class="ida-gn-application-input" name="primary_contact_name" type="text">
                      <p class="ida-gn-application-help">Main person IDA should contact. This can be changed later.</p>
                    </label>
                    <label class="ida-gn-application-field">
                      <span class="ida-gn-application-label">Secondary contact name</span>
                      <input class="ida-gn-application-input" name="secondary_contact_name" type="text">
                      <p class="ida-gn-application-help">Backup contact for continuity. This can be changed later.</p>
                    </label>
                    <label class="ida-gn-application-field ida-gn-application-field--full">
                      <span class="ida-gn-application-label">Address</span>
                      <textarea class="ida-gn-application-input ida-gn-application-input--textarea" name="address" rows="4"></textarea>
                      <p class="ida-gn-application-help">Include street address, city, state or region, and postal code.</p>
                    </label>
                    <label class="ida-gn-application-field">
                      <span class="ida-gn-application-label">Country</span>
                      <select class="ida-gn-application-input ida-gn-application-select" name="country" data-ida-application-country-select>
                        <option value="">Select country</option>
                        ${buildGlobalNetworkApplicationOptionMarkup(countryOptions)}
                      </select>
                    </label>
                    <label class="ida-gn-application-field" data-ida-application-country-other-field hidden>
                      <span class="ida-gn-application-label">If Other, please specify</span>
                      <input class="ida-gn-application-input" name="country_other" type="text">
                    </label>
                    <label class="ida-gn-application-field">
                      <span class="ida-gn-application-label">Telephone</span>
                      <input class="ida-gn-application-input" name="telephone" type="tel" placeholder="+1 410 296 0232">
                    </label>
                    <label class="ida-gn-application-field">
                      <span class="ida-gn-application-label">Additional phone numbers</span>
                      <input class="ida-gn-application-input" name="additional_phone_numbers" type="text" placeholder="Mobile, WhatsApp, or alternate office number">
                      <p class="ida-gn-application-help">Optional. Add extra numbers with country code.</p>
                    </label>
                    <label class="ida-gn-application-field">
                      <span class="ida-gn-application-label">General email</span>
                      <input class="ida-gn-application-input" name="email" type="email">
                    </label>
                    <label class="ida-gn-application-field">
                      <span class="ida-gn-application-label">Primary contact email</span>
                      <input class="ida-gn-application-input" name="primary_contact_email" type="email" data-ida-application-primary-email>
                      <p class="ida-gn-application-help">Main email IDA should use. This can be changed later.</p>
                    </label>
                    <label class="ida-gn-application-field">
                      <span class="ida-gn-application-label">Secondary contact email</span>
                      <input class="ida-gn-application-input" name="secondary_contact_email" type="email" data-ida-application-secondary-email>
                      <span class="ida-gn-application-inline-option">
                        <input type="checkbox" data-ida-application-secondary-same-email>
                        <span>Same as primary contact email</span>
                      </span>
                      <p class="ida-gn-application-help">Backup email for continuity. This can be changed later.</p>
                    </label>
                    <label class="ida-gn-application-field">
                      <span class="ida-gn-application-label">Website URL</span>
                      <input class="ida-gn-application-input" name="website_url" type="url" placeholder="https://">
                    </label>
                  </div>
                </section>

                <section class="ida-gn-application-panel" data-ida-application-panel="2">
                  <h3 class="ida-gn-application-panel-title">Organization profile</h3>
                  <p class="ida-gn-application-panel-note">Describe the legal, governance, and financial structure of the organization.</p>
                  <div class="ida-gn-application-grid">
                    <label class="ida-gn-application-field">
                      <span class="ida-gn-application-label">Year established</span>
                      <input class="ida-gn-application-input" name="year_established" type="number" min="1800">
                    </label>
                    <label class="ida-gn-application-field">
                      <span class="ida-gn-application-label">Organization structure type</span>
                      <select class="ida-gn-application-input ida-gn-application-select" name="organization_structure_type">
                        <option value="">Select one</option>
                        ${buildGlobalNetworkApplicationOptionMarkup(organizationStructureOptions)}
                      </select>
                    </label>
                    <label class="ida-gn-application-field ida-gn-application-field--full">
                      <span class="ida-gn-application-label">Governance structure</span>
                      <textarea class="ida-gn-application-input ida-gn-application-input--textarea" name="governance_structure" rows="4"></textarea>
                      <p class="ida-gn-application-help">Include board, executive director, committees, and other governance roles.</p>
                    </label>
                    ${buildGlobalNetworkApplicationYesNoFieldsets(organizationYesNoFields)}
                    <label class="ida-gn-application-field">
                      <span class="ida-gn-application-label">Estimated annual operating budget (USD)</span>
                      <input class="ida-gn-application-input" name="annual_operating_budget_usd" type="number" min="0" step="0.01">
                    </label>
                  </div>
                </section>

                <section class="ida-gn-application-panel" data-ida-application-panel="3">
                  <h3 class="ida-gn-application-panel-title">Members and branches</h3>
                  <p class="ida-gn-application-panel-note">Capture the current membership model and any local branches or chapters.</p>
                  <div class="ida-gn-application-grid">
                    ${buildGlobalNetworkApplicationYesNoFieldsets(memberYesNoFields)}
                    <label class="ida-gn-application-field">
                      <span class="ida-gn-application-label">Current members</span>
                      <input class="ida-gn-application-input" name="current_member_count" type="number" min="0">
                    </label>
                    <label class="ida-gn-application-field">
                      <span class="ida-gn-application-label">Annual membership dues (USD)</span>
                      <input class="ida-gn-application-input" name="annual_membership_dues_usd" type="number" min="0" step="0.01">
                    </label>
                    <label class="ida-gn-application-field ida-gn-application-field--full">
                      <span class="ida-gn-application-label">Membership categories</span>
                      <textarea class="ida-gn-application-input ida-gn-application-input--textarea" name="membership_categories" rows="4"></textarea>
                      <p class="ida-gn-application-help">Examples: individual, family, school, professional, student.</p>
                    </label>
                    <label class="ida-gn-application-field ida-gn-application-field--full">
                      <span class="ida-gn-application-label">Branches or chapters details</span>
                      <textarea class="ida-gn-application-input ida-gn-application-input--textarea" name="branches_or_chapters_details" rows="4"></textarea>
                    </label>
                  </div>
                </section>

                <section class="ida-gn-application-panel" data-ida-application-panel="4">
                  <h3 class="ida-gn-application-panel-title">Mission, activities, and practice context</h3>
                  <p class="ida-gn-application-panel-note">Describe the purpose of the organization, how it serves the community, and the dyslexia practice context in your country.</p>
                  <div class="ida-gn-application-subsection-stack">
                    <div class="ida-gn-application-subsection">
                      <h4 class="ida-gn-application-subsection-title">Mission and activities</h4>
                      <div class="ida-gn-application-grid">
                        <label class="ida-gn-application-field ida-gn-application-field--full">
                          <span class="ida-gn-application-label">Mission</span>
                          <textarea class="ida-gn-application-input ida-gn-application-input--textarea" name="mission" rows="4"></textarea>
                        </label>
                        ${buildGlobalNetworkApplicationYesNoFieldsets(missionYesNoFields.slice(0, 2))}
                        <label class="ida-gn-application-field ida-gn-application-field--full">
                          <span class="ida-gn-application-label">Typical public activities</span>
                          <textarea class="ida-gn-application-input ida-gn-application-input--textarea" name="public_activities_details" rows="4"></textarea>
                        </label>
                      </div>
                    </div>

                    <div class="ida-gn-application-subsection">
                      <h4 class="ida-gn-application-subsection-title">Practice context</h4>
                      <div class="ida-gn-application-grid">
                        <label class="ida-gn-application-field ida-gn-application-field--full">
                          <span class="ida-gn-application-label">Country definition of dyslexia</span>
                          <textarea class="ida-gn-application-input ida-gn-application-input--textarea" name="country_dyslexia_definition" rows="4"></textarea>
                          <p class="ida-gn-application-help">Include who formulated the definition.</p>
                        </label>
                        ${buildGlobalNetworkApplicationYesNoFieldsets(missionYesNoFields.slice(2), ["supports_country_definition", "supports_instructional_approaches"])}
                        <label class="ida-gn-application-field ida-gn-application-field--full">
                          <span class="ida-gn-application-label">Organization definition, if different</span>
                          <textarea class="ida-gn-application-input ida-gn-application-input--textarea" name="organization_dyslexia_definition" rows="4"></textarea>
                        </label>
                        <label class="ida-gn-application-field ida-gn-application-field--full">
                          <span class="ida-gn-application-label">Instructional approaches used in your country</span>
                          <textarea class="ida-gn-application-input ida-gn-application-input--textarea" name="instructional_approaches_country" rows="4"></textarea>
                        </label>
                        <label class="ida-gn-application-field ida-gn-application-field--full">
                          <span class="ida-gn-application-label">Remediation programs used in your country</span>
                          <textarea class="ida-gn-application-input ida-gn-application-input--textarea" name="remediation_programs_country" rows="4"></textarea>
                        </label>
                        <label class="ida-gn-application-field ida-gn-application-field--full">
                          <span class="ida-gn-application-label">Specific approaches or programs your organization advocates</span>
                          <textarea class="ida-gn-application-input ida-gn-application-input--textarea" name="advocated_approaches_programs" rows="4"></textarea>
                        </label>
                      </div>
                    </div>
                  </div>
                </section>

                <section class="ida-gn-application-panel" data-ida-application-panel="5">
                  <h3 class="ida-gn-application-panel-title">Supporting documents</h3>
                  <p class="ida-gn-application-panel-note">Upload one or more documents in any category, plus photos of the applicant contacts and the organization.</p>
                  <div class="ida-gn-application-document-list">
                    <h4 class="ida-gn-application-upload-heading">Required and supporting files</h4>
                    <label class="ida-gn-application-document">
                      <span><strong>NGO/non-profit/charity status</strong><span class="ida-gn-application-help">Required if the organization has formal status. Multiple files allowed.</span></span>
                      <input class="ida-gn-application-input" type="file" name="documents_nonprofit_status" multiple>
                    </label>
                    <label class="ida-gn-application-document">
                      <span><strong>Formal bylaws</strong><span class="ida-gn-application-help">Required if the association has bylaws. Multiple files allowed.</span></span>
                      <input class="ida-gn-application-input" type="file" name="documents_bylaws" multiple>
                    </label>
                    <label class="ida-gn-application-document">
                      <span><strong>Annual operating or financial report</strong><span class="ida-gn-application-help">Recommended if available. Multiple files allowed.</span></span>
                      <input class="ida-gn-application-input" type="file" name="documents_annual_report" multiple>
                    </label>
                    <label class="ida-gn-application-document">
                      <span><strong>Promotional or recruitment material sample</strong><span class="ida-gn-application-help">Required if recruitment material is produced. Multiple files allowed.</span></span>
                      <input class="ida-gn-application-input" type="file" name="documents_recruitment_material" multiple>
                    </label>
                    <label class="ida-gn-application-document">
                      <span><strong>Additional context pages</strong><span class="ida-gn-application-help">Mission, definition, instructional approaches, or other supporting information.</span></span>
                      <input class="ida-gn-application-input" type="file" name="documents_additional_context" multiple>
                    </label>

                    <h4 class="ida-gn-application-upload-heading">Photos and images</h4>
                    <label class="ida-gn-application-document">
                      <span><strong>Applicant / person completing this form photo</strong><span class="ida-gn-application-help">Upload a clear photo or headshot.</span></span>
                      <input class="ida-gn-application-input" type="file" name="photo_applicant_contact" accept="image/*">
                    </label>
                    <label class="ida-gn-application-document">
                      <span><strong>Primary contact photo</strong><span class="ida-gn-application-help">Upload a clear photo or headshot of the primary contact.</span></span>
                      <input class="ida-gn-application-input" type="file" name="photo_primary_contact" accept="image/*">
                    </label>
                    <label class="ida-gn-application-document">
                      <span><strong>Secondary contact photo</strong><span class="ida-gn-application-help">Optional clear photo or headshot of the secondary contact.</span></span>
                      <input class="ida-gn-application-input" type="file" name="photo_secondary_contact" accept="image/*">
                    </label>
                    <label class="ida-gn-application-document">
                      <span><strong>Organization photo</strong><span class="ida-gn-application-help">Upload a photo of the organization, office, centre, school, or main location.</span></span>
                      <input class="ida-gn-application-input" type="file" name="photo_organization" accept="image/*">
                    </label>
                    <label class="ida-gn-application-document">
                      <span><strong>Organization logo, high resolution</strong><span class="ida-gn-application-help">Recommended for profile pages and review materials.</span></span>
                      <input class="ida-gn-application-input" type="file" name="photo_organization_logo" accept=".jpg,.jpeg,.png,.webp,.svg,image/*">
                    </label>
                    <label class="ida-gn-application-document">
                      <span><strong>Additional activity photos</strong><span class="ida-gn-application-help">Optional examples of activities, schools, events, training, or community work.</span></span>
                      <input class="ida-gn-application-input" type="file" name="photo_activity_examples" accept="image/*" multiple>
                    </label>
                    <label class="ida-gn-application-document">
                      <span><strong>Add additional files</strong><span class="ida-gn-application-help">Optional. Upload any other relevant files that do not fit the categories above.</span></span>
                      <input class="ida-gn-application-input" type="file" name="documents_additional_files" multiple>
                    </label>
                  </div>
                </section>

                <section class="ida-gn-application-panel" data-ida-application-panel="6">
                  <h3 class="ida-gn-application-panel-title">Review and signature</h3>
                  <p class="ida-gn-application-panel-note">Acceptance into the Global Network Program and final participation level are subject to IDA approval.</p>
                  <div class="ida-gn-application-grid">
                    <label class="ida-gn-application-field">
                      <span class="ida-gn-application-label">Signature of contact</span>
                      <input class="ida-gn-application-input" name="signature_name" type="text" placeholder="Type full name">
                    </label>
                    <label class="ida-gn-application-field">
                      <span class="ida-gn-application-label">Date</span>
                      <input class="ida-gn-application-input" type="text" value="${new Date().toLocaleDateString("en-US", { year: "numeric", month: "long", day: "numeric" })}" readonly>
                    </label>
                  </div>
                  <div class="ida-gn-application-preview-note">
                    <strong>Front-end preview only.</strong>
                    <span>Submission, draft saving, and validation are intentionally not connected yet.</span>
                  </div>
                </section>

                <div class="ida-gn-application-actions">
                  <button class="ida-gn-application-button ida-gn-application-button--secondary" type="button" data-ida-application-prev-step disabled>Back</button>
                  <div class="ida-gn-application-actions-group">
                    <button class="ida-gn-application-button ida-gn-application-button--ghost" type="button" data-ida-application-draft-button>Save draft and finish later</button>
                    <button class="ida-gn-application-button ida-gn-application-button--primary" type="button" data-ida-application-next-step>Start application</button>
                    <button class="ida-gn-application-button ida-gn-application-button--submit" type="button" data-ida-application-submit-button hidden>Submit application</button>
                  </div>
                </div>
                <p class="ida-gn-application-status" data-ida-application-status aria-live="polite"></p>
              </div>
            </form>
          </div>
        </section>

        ${buildFooterMarkup()}
      </div>`;
  }

  function getNewsSpotlightMetaIconMarkup(type) {
    if (type === "date") {
      return `
        <svg viewBox="0 0 24 24" role="presentation" aria-hidden="true">
          <rect x="4.4" y="5.7" width="15.2" height="13.9" rx="2.2" fill="none" stroke="currentColor" stroke-width="1.8"></rect>
          <path d="M7.8 4v3.3M16.2 4v3.3M4.4 9.2h15.2" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"></path>
          <path d="M8.1 12.1h2.4M12.1 12.1h3.9M8.1 15.4h3.7M13.5 15.4h2.5" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"></path>
        </svg>`;
    }

    if (type === "category") {
      return `
        <svg viewBox="0 0 24 24" role="presentation" aria-hidden="true">
          <path d="M10.2 5.1H6.4a2.2 2.2 0 0 0-2.2 2.2v3.5c0 .6.2 1.1.6 1.5l5.9 5.9a2.2 2.2 0 0 0 3.1 0l4.4-4.4a2.2 2.2 0 0 0 0-3.1l-5.9-5.9a2.2 2.2 0 0 0-1.5-.7Z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"></path>
          <circle cx="8.2" cy="8.2" r="1.2" fill="currentColor"></circle>
        </svg>`;
    }

    return `
      <svg viewBox="0 0 24 24" role="presentation" aria-hidden="true">
        <path d="M9 14.9c0 1.9 1.9 3.5 4.3 3.5.7 0 1.4-.1 2-.4l3.1 1-.8-2.4c.6-.6 1-1.4 1-2.3 0-2.4-2.4-4.4-5.4-4.4S9 12.5 9 14.9Z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"></path>
        <path d="M6.2 12.6c-1.1-.7-1.8-1.8-1.8-3.1 0-2.4 2.4-4.4 5.4-4.4 2.2 0 4.1 1 4.9 2.5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"></path>
        <path d="M7 14.5 4.5 15.3l.7-2.1" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"></path>
      </svg>`;
  }

  function getNewsSpotlightArrowIconMarkup() {
    return `
      <svg viewBox="0 0 20 20" role="presentation" aria-hidden="true">
        <path d="M6 10h8" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"></path>
        <path d="m11 6 4 4-4 4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"></path>
      </svg>`;
  }

  function newsSpotlightMarkup() {
    const categories = [
      { label: "program announcnts", active: true },
      { label: "program annouements", active: false },
      { label: "Member spotlight features", active: false },
      { label: "regional highlights", active: false },
      { label: "event summaries", active: false },
      { label: "featured initiatives", active: false },
      { label: "Dyslexia Around the World stories", active: false },
    ];

    return `
      <div data-ida-news-spotlight-page>
        <section class="ida-news-hero">
          <div class="ida-news-hero-banner">
            <img src="${NEWS_SPOTLIGHT_HERO_IMAGE_SRC}" alt="" loading="eager">
            <div class="ida-news-hero-card">
              <h1 class="ida-news-hero-title">News and Global Spotlight</h1>
              <p class="ida-news-breadcrumb">Home &gt; News and Global Spotlight</p>
            </div>
          </div>
        </section>

        <section class="ida-news-content-section">
          <div class="ida-news-shell">
            <div class="ida-news-layout">
              <div class="ida-news-main-column">
                <article class="ida-news-featured-card">
                  <figure class="ida-news-featured-media">
                    <img src="${NEWS_SPOTLIGHT_FEATURED_IMAGE_SRC}" alt="Featured announcement for the IDA Global Network membership portal" loading="lazy">
                  </figure>
                  <div class="ida-news-featured-body">
                    <div class="ida-news-meta">
                      <span class="ida-news-meta-item">
                        <span class="ida-news-meta-icon" aria-hidden="true">${getNewsSpotlightMetaIconMarkup("date")}</span>
                        Jun. 6 2026
                      </span>
                      <span class="ida-news-meta-item">
                        <span class="ida-news-meta-icon" aria-hidden="true">${getNewsSpotlightMetaIconMarkup("category")}</span>
                        Announcement
                      </span>
                      <span class="ida-news-meta-item">
                        <span class="ida-news-meta-icon" aria-hidden="true">${getNewsSpotlightMetaIconMarkup("comments")}</span>
                        Comments (30)
                      </span>
                    </div>
                    <h2 class="ida-news-featured-title">IDA Global Network Launches Structured Membership Portal for International Organizations</h2>
                    <p class="ida-news-featured-excerpt">
                      The IDA Global Network has unveiled its new membership platform, providing a clear pathway for organizations worldwide to join and participate in the international ecosystem
                    </p>
                    <button class="ida-news-read-more" type="button">Read More</button>
                  </div>
                </article>

                <div class="ida-news-no-posts" aria-label="No More Posts">
                  <span class="ida-news-no-posts-line" aria-hidden="true"></span>
                  <span class="ida-news-no-posts-diamond" aria-hidden="true"></span>
                  <span class="ida-news-no-posts-label">No More Posts</span>
                  <span class="ida-news-no-posts-diamond" aria-hidden="true"></span>
                  <span class="ida-news-no-posts-line" aria-hidden="true"></span>
                </div>
              </div>

              <aside class="ida-news-sidebar" aria-labelledby="ida-news-categories-title">
                <div class="ida-news-search-row" role="search" aria-label="Search news">
                  <div class="ida-news-search-shell">
                    <label class="ida-news-search-field">
                      <span class="sr-only">Enter Keyword</span>
                      <input type="search" placeholder="Enter Keyword" aria-label="Enter Keyword">
                    </label>
                    <button class="ida-news-search-button" type="button" aria-label="Search news">
                      <svg viewBox="0 0 24 24" role="presentation" aria-hidden="true">
                        <circle cx="10.5" cy="10.5" r="5.6" fill="none" stroke="currentColor" stroke-width="2"></circle>
                        <path d="m14.7 14.7 4.2 4.2" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                      </svg>
                    </button>
                  </div>
                </div>
                <div class="ida-news-sidebar-card">
                  <h2 class="ida-news-sidebar-title" id="ida-news-categories-title">Categories</h2>
                  <ul class="ida-news-category-list">
                    ${categories.map((category) => `
                      <li class="ida-news-category-item">
                        <button class="ida-news-category-button${category.active ? " is-active" : ""}" type="button">
                          <span class="ida-news-category-label">${category.label}</span>
                          <span class="ida-news-category-arrow" aria-hidden="true">${getNewsSpotlightArrowIconMarkup()}</span>
                        </button>
                      </li>`).join("")}
                  </ul>
                </div>
              </aside>
            </div>
          </div>
        </section>

        ${buildFooterMarkup()}
      </div>`;
  }

  function getDirectoryShareIconMarkup(platform) {
    if (platform === "facebook") {
      return `
        <svg viewBox="0 0 24 24" role="presentation" aria-hidden="true">
          <path d="M13.49 20v-7.12h2.39l.36-2.78h-2.75V8.32c0-.8.22-1.35 1.38-1.35h1.48V4.49c-.26-.03-1.13-.11-2.14-.11-2.12 0-3.58 1.29-3.58 3.66v2.06H8.25v2.78h2.38V20h2.86Z" fill="currentColor"></path>
        </svg>`;
    }

    if (platform === "linkedin") {
      return `
        <svg viewBox="0 0 24 24" role="presentation" aria-hidden="true">
          <path d="M6.7 8.9a1.8 1.8 0 1 0 0-3.6 1.8 1.8 0 0 0 0 3.6Zm-1.5 2.2h3v9h-3v-9Zm4.9 0h2.9v1.2h.04c.4-.76 1.4-1.56 2.95-1.56 3.16 0 3.74 2.08 3.74 4.79v4.53h-3v-4.01c0-.96-.02-2.19-1.33-2.19-1.34 0-1.54 1.04-1.54 2.12v4.08h-3v-9Z" fill="currentColor"></path>
        </svg>`;
    }

    if (platform === "instagram") {
      return `
        <svg viewBox="0 0 24 24" role="presentation" aria-hidden="true">
          <rect x="4.2" y="4.2" width="15.6" height="15.6" rx="4.7" fill="none" stroke="currentColor" stroke-width="1.9"></rect>
          <circle cx="12" cy="12" r="3.7" fill="none" stroke="currentColor" stroke-width="1.9"></circle>
          <circle cx="17.2" cy="6.9" r="1.1" fill="currentColor"></circle>
        </svg>`;
    }

    if (platform === "youtube") {
      return `
        <svg viewBox="0 0 24 24" role="presentation" aria-hidden="true">
          <path d="M20.3 8.2a3 3 0 0 0-2.1-2.1c-1.8-.5-6.2-.5-6.2-.5s-4.4 0-6.2.5a3 3 0 0 0-2.1 2.1c-.5 1.8-.5 3.8-.5 3.8s0 2 .5 3.8a3 3 0 0 0 2.1 2.1c1.8.5 6.2.5 6.2.5s4.4 0 6.2-.5a3 3 0 0 0 2.1-2.1c.5-1.8.5-3.8.5-3.8s0-2-.5-3.8ZM10.4 15.1V8.9l5.1 3.1-5.1 3.1Z" fill="currentColor"></path>
        </svg>`;
    }

    return `
      <svg viewBox="0 0 24 24" role="presentation" aria-hidden="true">
        <path d="M5.27 4h3.52l4.05 5.76L17.9 4H21l-6.78 7.72L21.8 20h-3.53l-4.35-6.17L8.44 20H5.33l7.08-8.08L5.27 4Zm4.07 1.98H8.2l6.46 9.01.58.8h1.15L9.92 6.78l-.58-.8Z" fill="currentColor"></path>
      </svg>`;
  }

  function getDirectoryPublicSocialLinks(member) {
    if (isAssociateDirectoryMember(member)) {
      return [];
    }

    return Array.isArray(member?.socialLinks)
      ? member.socialLinks.filter((item) => item && item.platform && item.url)
      : [];
  }

  function isAssociateDirectoryMember(member) {
    return String(member?.tier || "").trim().toLowerCase() === "associate";
  }

  function isPartnerDirectoryMember(member) {
    return String(member?.tier || "").trim().toLowerCase() === "partner";
  }

  function getDirectoryTierPriority(member) {
    const normalizedTier = String(member?.tier || "").trim().toLowerCase();

    if (normalizedTier === "partner") {
      return 0;
    }

    if (normalizedTier === "contributor") {
      return 1;
    }

    if (normalizedTier === "associate") {
      return 2;
    }

    return 3;
  }

  function getDirectoryCardMembers() {
    return DIRECTORY_MEMBERS
      .filter((member) => !isAssociateDirectoryMember(member))
      .sort((firstMember, secondMember) => getDirectoryTierPriority(firstMember) - getDirectoryTierPriority(secondMember));
  }

  function getDirectoryMarkerStyle(member) {
    if (!isPartnerDirectoryMember(member)) {
      return undefined;
    }

    return {
      initial: {
        fill: "#d4af37",
      },
    };
  }

  function buildDirectoryShareMarkup(member) {
    return getDirectoryPublicSocialLinks(member).slice(0, 4).map((item) => `
      <span class="ida-directory-member-share-pill">
        ${getDirectoryShareIconMarkup(item.platform)}
      </span>`).join("");
  }

  function buildDirectorySocialLinksMarkup(member) {
    return getDirectoryPublicSocialLinks(member).map((item) => `
      <a
        class="ida-directory-info-social-link"
        href="${item.url}"
        target="_blank"
        rel="noreferrer"
        aria-label="${item.label}"
      >
        <span class="ida-directory-info-social-link-icon" aria-hidden="true">
          ${getDirectoryShareIconMarkup(item.platform)}
        </span>
        <span>${item.label}</span>
      </a>`).join("");
  }

  function getDirectoryCardTitle(member) {
    if (member.cardTitle) {
      return member.cardTitle;
    }

    const location = (member.location || "").trim();
    const cleanedName = (member.name || "")
      .replace(/\s*\(([^)]+)\)\s*$/, (match, suffix) => {
        return location && suffix.trim().toLowerCase() === location.toLowerCase()
          ? ""
          : match;
      })
      .replace(/\s*,?\s+(?:ltd|limited)\.?$/i, "")
      .trim()
      .replace(/[,\s]+$/, "");

    if (!location) {
      return cleanedName;
    }

    return cleanedName.toLowerCase().includes(location.toLowerCase())
      ? cleanedName
      : `${cleanedName}, ${location}`;
  }

  function getDirectoryCardHeading(member) {
    if (isAssociateDirectoryMember(member)) {
      return member.name || getDirectoryCardTitle(member);
    }

    return getDirectoryCardTitle(member);
  }

  function getDirectoryCardLocation(member) {
    return member.location || member.address || "";
  }

  function getDirectoryCardTier(member) {
    return member.tier || "";
  }

  function buildDirectoryCardsMarkup() {
    return getDirectoryCardMembers().map((member) => `
      <article class="ida-directory-member-card${isPartnerDirectoryMember(member) ? " ida-directory-member-card--partner" : ""}" data-ida-directory-card="${member.id}">
        <button
          class="ida-directory-member-button"
          type="button"
          data-ida-directory-select="${member.id}"
          aria-pressed="false"
        >
          ${getDirectoryPublicSocialLinks(member).length ? `
            <span class="ida-directory-member-toggle" aria-hidden="true">
              <span class="ida-directory-member-toggle-plus">+</span>
              <span class="ida-directory-member-toggle-arrow">
                <svg viewBox="0 0 24 24" role="presentation">
                  <path d="M6 9.5 12 15.5 18 9.5" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
              </span>
            </span>
            <span class="ida-directory-member-share" aria-hidden="true">
              ${buildDirectoryShareMarkup(member)}
            </span>`
            : ""}
          <figure class="ida-directory-member-figure">
            <img src="${member.image}" alt="${member.name}" loading="lazy">
          </figure>
          <div class="ida-directory-member-caption">
            <h3 class="ida-directory-member-name">${getDirectoryCardHeading(member)}</h3>
            <p class="ida-directory-member-location">${getDirectoryCardLocation(member)}</p>
            <p class="ida-directory-member-tier">${getDirectoryCardTier(member)}</p>
          </div>
        </button>
      </article>`).join("");
  }

  function buildDirectoryMapMarkup() {
    return `
      <div
        class="ida-directory-map-canvas"
        data-ida-directory-map-canvas
        role="group"
        aria-label="Directory member map"
      >
        <div class="ida-directory-map-inner">
          <div class="ida-directory-vector-map" id="ida-directory-vector-map" data-ida-directory-vector-map aria-hidden="true"></div>
        </div>
      </div>`;
  }

  function directoryMarkup() {
    return `
      <div data-ida-directory-page>
        <section class="ida-directory-hero">
          <div class="ida-directory-hero-banner" aria-hidden="true">
            <img src="${DIRECTORY_HERO_IMAGE_SRC}" alt="" loading="eager">
          </div>
          <div class="ida-directory-hero-card">
            <h1 class="ida-directory-hero-title">Directory</h1>
            <p class="ida-directory-breadcrumb">Home &gt; Directory</p>
          </div>
        </section>

        <section class="ida-directory-members-section">
          <div class="container-fluid ida-directory-shell">
            <div class="ida-directory-members-heading">
              <div class="ida-directory-heading-accent" aria-hidden="true">
                <span></span>
                <i></i>
              </div>
              <h2 class="ida-directory-section-title">Meet Our Members</h2>
              <div class="ida-directory-heading-accent ida-directory-heading-accent--reverse" aria-hidden="true">
                <i></i>
                <span></span>
              </div>
            </div>
            <div class="ida-directory-member-grid">
              ${buildDirectoryCardsMarkup()}
            </div>
            <div class="ida-directory-more">
              <button class="ida-directory-more-button" type="button" data-ida-directory-jump>
                Show More
              </button>
            </div>
          </div>
        </section>

        <section class="ida-directory-map-section" data-ida-directory-map>
          <div class="container-fluid ida-directory-shell">
            <div class="ida-directory-map-heading">
              <h2 class="ida-directory-map-title">Our Members All-Over-The-World</h2>
              <div class="ida-directory-map-title-accent" aria-hidden="true"></div>
            </div>
            <div class="ida-directory-map-grid">
              <aside class="ida-directory-info-card" data-ida-directory-panel>
                <div class="ida-directory-info-empty" data-ida-directory-empty>
                  <p class="ida-directory-info-empty-copy">Click on the Location to Show Information</p>
                  <span class="ida-directory-info-hand" aria-hidden="true">
                    <svg viewBox="0 0 64 64" role="presentation">
                      <path d="M20 30V18a4 4 0 1 1 8 0v10h2V14a4 4 0 1 1 8 0v14h2V18a4 4 0 1 1 8 0v17l4-4a4 4 0 0 1 6 5l-9 14c-2.5 4-7 6-11.8 6H28c-7.7 0-14-6.3-14-14V30a4 4 0 1 1 8 0Z" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"></path>
                      <path d="M26 52c0-6.8 5.2-12 12-12" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round"></path>
                    </svg>
                  </span>
                </div>

                <div class="ida-directory-info-content" data-ida-directory-content hidden>
                  <div class="ida-directory-info-top">
                    <figure class="ida-directory-info-figure">
                      <img
                        src=""
                        alt=""
                        loading="lazy"
                        data-ida-directory-image
                      >
                    </figure>
                    <div class="ida-directory-info-heading">
                      <div class="ida-directory-info-title-row">
                        <a
                          class="ida-directory-info-name"
                          data-ida-directory-name
                          href="#"
                          target="_blank"
                          rel="noreferrer"
                        ></a>
                        <span class="ida-directory-info-meta">
                          <span class="ida-directory-info-meta-label">Tier</span>
                          <span class="ida-directory-info-meta-icon" aria-hidden="true"></span>
                          <span class="ida-directory-info-pill" data-ida-directory-tier></span>
                        </span>
                      </div>
                      <p class="ida-directory-info-address" data-ida-directory-address></p>
                    </div>
                  </div>

                  <p class="ida-directory-info-description" data-ida-directory-description></p>

                  <div class="ida-directory-info-contact">
                    <p class="ida-directory-info-contact-label">Contact</p>
                    <div class="ida-directory-info-contact-values">
                      <p data-ida-directory-phone-row hidden>Phone: <a data-ida-directory-phone href="#"></a></p>
                      <p data-ida-directory-email-row hidden>Email: <a data-ida-directory-email href="#"></a></p>
                      <p data-ida-directory-website-row hidden>Website: <a data-ida-directory-website href="#" target="_blank" rel="noreferrer"></a></p>
                      <p data-ida-directory-social-row hidden>Social: <span class="ida-directory-info-social-links" data-ida-directory-social-links></span></p>
                    </div>
                  </div>
                </div>
              </aside>

              <div class="ida-directory-map-stage">
                <div class="ida-directory-map-frame">
                  ${buildDirectoryMapMarkup()}
                </div>
              </div>
            </div>
          </div>
        </section>

        ${buildFooterMarkup()}
      </div>`;
  }

  function contactMarkup() {
    return `
      <div data-ida-contact-page>
        <section class="ida-contact-hero">
          <div class="ida-contact-hero-banner" aria-hidden="true">
            <img src="${CONTACT_HERO_IMAGE_SRC}" alt="" loading="eager">
          </div>
          <div class="ida-contact-hero-card">
            <h1 class="ida-contact-hero-title">Contact</h1>
            <p class="ida-contact-breadcrumb">Home &gt; Contact</p>
          </div>
        </section>

        <section class="ida-contact-details-section" aria-labelledby="ida-contact-details-title">
          <div class="ida-contact-shell">
            <div class="ida-contact-details-card">
              <div class="entry-content">
                <h2 class="sr-only" id="ida-contact-details-title">Additional contact details</h2>
                <p><strong>International Dyslexia Association</strong><br>1829 Reisterstown Road Suite 350 Pikesville, MD 21208</p>
                <p>(410) 296-0232 Tel<br>(410) 321-5069 Fax</p>
                <p>The International Dyslexia Association is located in the Baltimore suburb of Pikesville, Maryland. We are approximately 30 minutes from Baltimore-Washington International (BWI) Airport. The office is open Monday &ndash; Friday, 8:00 am &ndash; 5:00 pm Eastern Standard Time. The office is closed during federal holidays and for one week during the annual conference.</p>
                <p><strong>Need Assistance?</strong></p>
                <ul class="ida-contact-email-list">
                  <li>General Inquiries &ndash; <span style="text-decoration: underline; color: #6f99c8;"><a style="color: #6f99c8; text-decoration: underline;" href="mailto:info@dyslexiaida.org" target="_blank" rel="noopener noreferrer">info@dyslexiaida.org</a></span></li>
                  <li>Conference &amp; Events &ndash; <a href="mailto:conference26@dyslexiaida.org"><span style="text-decoration: underline; color: #6f99c8;">conference26@dyslexiaida.org</span></a></li>
                  <li>Membership &ndash; <span style="text-decoration: underline;"><a href="mailto:member@dyslexiaida.org" target="_blank" rel="noopener noreferrer">member@dyslexiaida.org</a></span></li>
                  <li>IDA In Your Area, Local Branches, Global Partners &ndash;</li>
                  <li>Fundraising, Making a Donation, Planned Giving &ndash; <span style="text-decoration: underline;"><a href="mailto:donations@dyslexiaida.org"><span style="color: #6f99c8; text-decoration: underline;">donations@dyslexiaida.org</span></a></span></li>
                  <li>Bookstore &ndash; <span style="text-decoration: underline; color: #6f99c8;"><a style="color: #6f99c8; text-decoration: underline;" href="mailto:bookstore@dyslexiaida.org" target="_blank" rel="noopener noreferrer">bookstore@dyslexiaida.org</a></span></li>
                  <li>Publications &ndash; <a href="mailto:info@dyslexiaida.org" target="_blank" rel="noopener">info@dyslexiaida.org</a></li>
                  <li>Human Resources&nbsp;</li>
                  <li>Media Requests &ndash; <a href="mailto:info@dyslexiaida.org">info@dyslexiaida.org</a></li>
                </ul>
                <p>(Please <span style="text-decoration: underline;"><em>do not</em></span> send books or other publications to be sold in IDA&rsquo;s online bookstore. We are not presently reviewing unsolicited materials)</p>
                <h3>Accreditation</h3>
                <p>Email: <a href="mailto:accreditation@dyslexiaida.org">accreditation@dyslexiaida.org</a><br>Phone: 410-296-0232</p>
                <p>&nbsp;</p>
                <p>To provide IDA with updates regarding member status, including a member&rsquo;s passing, please contact <a href="mailto:member@DyslexiaIDA.org">member@DyslexiaIDA.org</a>.</p>
              </div>
            </div>
          </div>
        </section>

        <section class="ida-contact-content-section">
          <div class="ida-contact-shell">
            <div class="ida-contact-grid">
              <div class="ida-contact-copy-column">
                <div class="ida-contact-section-heading">
                  <h2 class="ida-contact-section-title">We Welcome Your Enquiry</h2>
                  <div class="ida-contact-section-accent" aria-hidden="true">
                    <span class="ida-contact-section-accent-line ida-contact-section-accent-line--primary"></span>
                    <span class="ida-contact-section-accent-line ida-contact-section-accent-line--secondary"></span>
                  </div>
                </div>

                <form class="ida-contact-form" data-ida-contact-form>
                  <div class="ida-contact-form-grid">
                    <label class="ida-contact-field">
                      <span class="sr-only">Email</span>
                      <input type="email" name="email" placeholder="E-mail" autocomplete="email" required>
                    </label>
                    <label class="ida-contact-field">
                      <span class="sr-only">Phone</span>
                      <input type="tel" name="phone" placeholder="Phone" autocomplete="tel">
                    </label>
                    <label class="ida-contact-field">
                      <span class="sr-only">Name</span>
                      <input type="text" name="name" placeholder="Name" autocomplete="name" required>
                    </label>
                    <label class="ida-contact-field ida-contact-field--select">
                      <span class="sr-only">Enquiry type</span>
                      <select name="subject" required>
                        <option value="" selected disabled>Enquiry type</option>
                        <option value="General Enquiry">General enquiry</option>
                        <option value="Membership">Membership</option>
                        <option value="Partnership">Partnership</option>
                        <option value="Events">Events</option>
                        <option value="Media">Media</option>
                      </select>
                    </label>
                  </div>

                  <label class="ida-contact-field ida-contact-field--textarea">
                    <span class="sr-only">Message</span>
                    <textarea name="message" placeholder="Message" rows="5" required></textarea>
                  </label>

                  <div class="ida-contact-form-actions">
                    <button class="ida-contact-submit" type="submit" data-ida-contact-submit>Submit</button>
                    <p class="ida-contact-status" data-ida-contact-status hidden aria-live="polite"></p>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </section>

        ${buildFooterMarkup()}
      </div>`;
  }

  function buildLoginShowcaseMarkup() {
    const logoSource = getFooterLogoSource();

    return `
      <div class="ida-login-showcase-card" data-ida-login-showcase>
        <div class="ida-login-showcase-copy">
          <h2 class="ida-login-showcase-title">Member Portal</h2>
          <p class="ida-login-showcase-text">
            The Member Portal provides participating organizations with access to profile management,
            announcements, events, collaborative tools, resources, and other program functions.
          </p>
        </div>
        <div class="ida-login-showcase-features">
          ${LOGIN_SHOWCASE_FEATURES.map((feature) => `
            <article class="ida-login-showcase-feature">
              <span class="ida-login-showcase-feature-icon" aria-hidden="true">
                <img src="${feature.icon}" alt="" loading="lazy">
              </span>
              <div class="ida-login-showcase-feature-copy">
                <h2 class="ida-login-showcase-feature-title">${feature.title}</h2>
                <p class="ida-login-showcase-feature-text">${feature.copy}</p>
              </div>
            </article>`).join("")}
        </div>
      </div>`;
  }

  function buildLoginHeroMarkup() {
    return `
      <section class="ida-login-hero" data-ida-login-hero>
        <div class="ida-login-hero-banner">
          <img src="${LOGIN_HERO_IMAGE_SRC}" alt="" loading="eager">
          <div class="ida-login-hero-card">
            <h1 class="ida-login-hero-title">Sign In</h1>
            <p class="ida-login-breadcrumb">Home &gt; Sign In</p>
          </div>
        </div>
      </section>`;
  }

  function ensureLoginFooter() {
    const existing = document.querySelector("[data-ida-login-footer]");

    if (existing) {
      syncInjectedFooterLogo();
      syncInjectedFooterLinks();
      return;
    }

    const originalFooter = document.querySelector(".ch-footer-section, footer");
    const form = document.querySelector("#root > form");

    if (originalFooter) {
      originalFooter.classList.add("ida-route-hidden-original");
    }

    if (form) {
      form.insertAdjacentHTML("afterend", `<div data-ida-login-footer>${buildFooterMarkup()}</div>`);
    } else if (originalFooter) {
      originalFooter.insertAdjacentHTML("beforebegin", `<div data-ida-login-footer>${buildFooterMarkup()}</div>`);
    }

    syncInjectedFooterLogo();
    syncInjectedFooterLinks();
  }

  function enhanceLoginForm() {
    const form = document.querySelector("#root > form");

    if (!form) {
      return false;
    }

    const wrapper = form.querySelector(".ch-reg-log-wrapper");
    const container = wrapper ? wrapper.querySelector(".container") : null;
    const row = container ? wrapper.querySelector(".row") : null;
    const leftColumn = row ? row.querySelector(".col-lg-6.col-xl-7") : null;
    const rightColumn = row ? row.querySelector(".col-lg-6.col-xl-5") : null;
    const authForm = form.querySelector(".auth-form-wrapper");
    const personalInfoWrapper = authForm ? authForm.querySelector(".personal-info-wrapper") : null;
    const submitButton = authForm ? authForm.querySelector('button[type="submit"]') : null;
    const utilityRow = authForm
      ? authForm.querySelector(".form-check.d-flex.align-items-center.gap-4.justify-content-between.w-100")
      : null;
    const rememberBlock = utilityRow ? utilityRow.querySelector("div") : null;
    const forgotBlock = utilityRow ? utilityRow.querySelector("h6") : null;
    const forgotLink = forgotBlock ? forgotBlock.querySelector("a") : null;
    const registerBlock = authForm
      ? Array.from(authForm.querySelectorAll("h6")).find((element) => /account/i.test(element.textContent))
      : null;
    const registerLink = registerBlock ? registerBlock.querySelector("a") : null;
    const emailLabel = authForm ? authForm.querySelector('label[for="personal_email"]') : null;
    const emailInput = authForm ? authForm.querySelector("#personal_email") : null;
    const passwordLabel = authForm ? authForm.querySelector('label[for="personal_pass"]') : null;
    const passwordInput = authForm ? authForm.querySelector("#personal_pass") : null;

    if (!wrapper || !container || !row || !leftColumn || !rightColumn || !authForm || !personalInfoWrapper || !submitButton) {
      return false;
    }

    form.dataset.idaLoginReady = "true";
    form.classList.add("ida-login-form");
    wrapper.classList.add("ida-login-section");
    container.classList.add("ida-login-shell");
    row.classList.add("ida-login-layout");
    leftColumn.classList.add("ida-login-showcase-column");
    rightColumn.classList.add("ida-login-panel-column");
    authForm.classList.add("ida-login-panel");
    personalInfoWrapper.classList.add("ida-login-fields");

    if (!form.querySelector("[data-ida-login-hero]")) {
      wrapper.insertAdjacentHTML("beforebegin", buildLoginHeroMarkup());
    }

    if (!leftColumn.querySelector("[data-ida-login-showcase]")) {
      leftColumn.innerHTML = buildLoginShowcaseMarkup();
    }

    const logo = authForm.querySelector("img.logo");
    if (logo) {
      logo.remove();
    }

    const legacyHeading = authForm.querySelector("h4");
    if (legacyHeading) {
      legacyHeading.remove();
    }

    let intro = authForm.querySelector("[data-ida-login-intro]");
    if (!intro) {
      intro = document.createElement("div");
      intro.dataset.idaLoginIntro = "true";
      intro.className = "ida-login-intro";
      intro.innerHTML = `
        <span class="ida-login-intro-icon" aria-hidden="true">
          <img src="/assets/sign-in/login-icon.png" alt="" loading="lazy">
        </span>
        <h2 class="ida-login-title">Member Sign In</h2>
        <p class="ida-login-subtitle">Access your organization's member account</p>
      `;
      authForm.prepend(intro);
    }

    if (emailLabel) {
      emailLabel.textContent = "E-mail";
    }

    if (passwordLabel) {
      passwordLabel.textContent = "Password";
    }

    if (emailInput) {
      emailInput.classList.add("ida-login-input");
      emailInput.setAttribute("placeholder", "E-mail");
      emailInput.setAttribute("autocomplete", "email");
      if (emailInput.value === "user@gmail.com") {
        emailInput.value = "";
      }
    }

    if (passwordInput) {
      passwordInput.classList.add("ida-login-input");
      passwordInput.setAttribute("placeholder", "Password");
      passwordInput.setAttribute("autocomplete", "current-password");
      if (passwordInput.value === "1234") {
        passwordInput.value = "";
      }
    }

    submitButton.textContent = "Sign in to portal";
    submitButton.classList.add("ida-login-submit");

    if (registerBlock && registerLink) {
      const applyLink = document.createElement("a");

      bindInertLink(applyLink);
      registerBlock.className = "ida-login-register-wrap";
      registerBlock.textContent = "";
      applyLink.textContent = "Apply for Membership";
      applyLink.className = "ida-login-register";
      registerBlock.appendChild(applyLink);
    }

    if (utilityRow) {
      utilityRow.classList.add("ida-login-utility-row");
    }

    if (rememberBlock) {
      rememberBlock.classList.add("ida-login-remember");
      rememberBlock.hidden = true;
    }

    if (forgotBlock) {
      forgotBlock.className = "ida-login-links";
    }

    if (forgotLink) {
      forgotLink.textContent = "Forgot Password?";
      forgotLink.classList.add("ida-login-forgot-link");
    }

    if (forgotBlock && !forgotBlock.querySelector("[data-ida-login-support]")) {
      const support = document.createElement("span");
      support.dataset.idaLoginSupport = "true";
      support.className = "ida-login-support";
      support.textContent = "Need support?";
      forgotBlock.appendChild(support);
    }

    if (registerBlock && utilityRow) {
      registerBlock.insertAdjacentElement("afterend", utilityRow);
    }

    let socialBlock = authForm.querySelector("[data-ida-login-social]");
    if (!socialBlock) {
      socialBlock = document.createElement("div");
      socialBlock.dataset.idaLoginSocial = "true";
      socialBlock.className = "ida-login-social";
      socialBlock.innerHTML = `
        <p class="ida-login-social-label">Or log in with:</p>
        <div class="ida-login-social-list" aria-label="Social sign-in options">
          <button type="button" class="ida-login-social-button" aria-label="Alternative sign-in option 1">
            <img src="/assets/sign-in/social-icon-1.png" alt="" loading="lazy">
          </button>
          <button type="button" class="ida-login-social-button" aria-label="Alternative sign-in option 2">
            <img src="/assets/sign-in/social-icon-2.png" alt="" loading="lazy">
          </button>
          <button type="button" class="ida-login-social-button" aria-label="Sign in with Facebook">
            <img src="/assets/sign-in/facebook-logo.png" alt="" loading="lazy">
          </button>
        </div>
      `;
    }

    if (utilityRow && utilityRow.nextElementSibling !== socialBlock) {
      utilityRow.insertAdjacentElement("afterend", socialBlock);
    } else if (!utilityRow && registerBlock && registerBlock.nextElementSibling !== socialBlock) {
      registerBlock.insertAdjacentElement("afterend", socialBlock);
    } else if (!utilityRow && !registerBlock && !authForm.contains(socialBlock)) {
      authForm.appendChild(socialBlock);
    }

    return true;
  }

  function cleanupLogin() {
    restoreHeader();
    document.body.classList.remove("ida-login-page-active");

    const injectedFooter = document.querySelector("[data-ida-login-footer]");
    if (injectedFooter) {
      injectedFooter.remove();
    }

    const originalFooter = document.querySelector(".ch-footer-section, footer");
    if (originalFooter) {
      originalFooter.classList.remove("ida-route-hidden-original");
    }
  }

  function applyLogin() {
    applyHeader();
    document.body.classList.add("ida-login-page-active");

    if (!enhanceLoginForm()) {
      return;
    }

    ensureLoginFooter();
  }

  function initContactPage() {
    const page = document.querySelector("[data-ida-contact-page]");

    if (!page || page.dataset.idaContactReady === "true") {
      return;
    }

    page.dataset.idaContactReady = "true";

    const form = page.querySelector("[data-ida-contact-form]");
    const submitButton = page.querySelector("[data-ida-contact-submit]");
    const status = page.querySelector("[data-ida-contact-status]");

    if (!form || !submitButton || !status) {
      return;
    }

    const setStatus = (message, state = "") => {
      status.textContent = message;
      status.hidden = !message;

      if (state) {
        status.dataset.state = state;
      } else {
        delete status.dataset.state;
      }
    };

    const setBusy = (isBusy) => {
      submitButton.disabled = isBusy;
      submitButton.textContent = isBusy ? "Submitting..." : "Submit";
    };

    form.addEventListener("submit", async (event) => {
      event.preventDefault();

      if (typeof form.reportValidity === "function" && !form.reportValidity()) {
        return;
      }

      setBusy(true);
      setStatus("", "");

      const formData = new FormData(form);
      const phone = String(formData.get("phone") || "").trim();
      const message = String(formData.get("message") || "").trim();

      if (phone) {
        formData.set("message", `Phone: ${phone}\n\n${message}`);
      }

      try {
        const response = await fetch("/api/contact/submit", {
          method: "POST",
          headers: {
            Accept: "application/json",
          },
          body: formData,
        });

        let payload = null;

        try {
          payload = await response.json();
        } catch (error) {
          payload = null;
        }

        if (!response.ok || !payload || payload.success !== true) {
          throw new Error(payload && payload.message ? payload.message : "Unable to send your message right now.");
        }

        form.reset();
        setStatus(payload.message || "Message sent successfully.", "success");
      } catch (error) {
        setStatus(error && error.message ? error.message : "Unable to send your message right now.", "error");
      } finally {
        setBusy(false);
      }
    });
  }

  function storeOriginalMarkup(element) {
    if (element && !element.dataset.idaOriginalHtml) {
      element.dataset.idaOriginalHtml = element.innerHTML;
    }
  }

  function restoreOriginalMarkup(element) {
    if (element && element.dataset.idaOriginalHtml) {
      element.innerHTML = element.dataset.idaOriginalHtml;
      delete element.dataset.idaOriginalHtml;
    }
  }

  function restoreHeader() {
    document.body.classList.remove("ida-homepage-active");

    const header = document.querySelector(".ch-header-area");
    const mobileMenu = document.querySelector(".mobile-menu");
    const desktopActionColumn = header
      ? header.querySelector(
        ".header-actions-column, .row > .header-actions-column, .row > [class*='justify-content-end']"
      )
      : null;
    const mobileActionRoot = mobileMenu ? mobileMenu.querySelector(".mt-4") : null;

    restoreOriginalMarkup(desktopActionColumn);
    restoreOriginalMarkup(mobileActionRoot);

    if (!header) {
      return;
    }

    header.classList.remove("ida-home-header");
  }

  function applyHeader() {
    const header = document.querySelector(".ch-header-area");

    if (!header) {
      return;
    }

    document.body.classList.add("ida-homepage-active");
    header.classList.add("ida-home-header");

    const mobileMenu = document.querySelector(".mobile-menu");
    const desktopActionColumn = header.querySelector(
      ".header-actions-column, .row > .header-actions-column, .row > [class*='justify-content-end']"
    );
    const mobileActionRoot = mobileMenu ? mobileMenu.querySelector(".mt-4") : null;

    function ensureActionLink(link, { text, className }) {
      if (!link) {
        return null;
      }

      link.textContent = text;
      link.classList.add(className);
      return link;
    }

    function ensureApplyLink(group, mode) {
      let applyLink = group.querySelector(`[data-ida-header-apply="${mode}"]`);

      if (!applyLink) {
        applyLink = document.createElement("a");
        applyLink.href = GLOBAL_NETWORK_APPLICATION_PAGE_HREF;
        applyLink.dataset.idaHeaderApply = mode;
        applyLink.dataset.idaSpaLink = "true";
        applyLink.className = mode === "desktop" ? "ch-btn ida-home-signin" : "ida-home-signin";
        group.appendChild(applyLink);
      }

      applyLink.href = GLOBAL_NETWORK_APPLICATION_PAGE_HREF;
      applyLink.dataset.idaSpaLink = "true";
      applyLink.textContent = "Apply for membership";
      applyLink.classList.add("ida-home-signin");
      applyLink.removeAttribute("onclick");
      return applyLink;
    }

    if (desktopActionColumn) {
      storeOriginalMarkup(desktopActionColumn);

      const loginLink = desktopActionColumn.querySelector('a[href="/login"]');

      if (loginLink) {
        let actionGroup = desktopActionColumn.querySelector("[data-ida-actions='desktop']");

        if (!actionGroup) {
          actionGroup = document.createElement("div");
          actionGroup.dataset.idaActions = "desktop";
          actionGroup.className = "header-action-group ida-home-action-group";
          desktopActionColumn.prepend(actionGroup);
        }

        const normalizedLoginLink = ensureActionLink(loginLink, {
          text: "Sign In",
          className: "ida-home-signin",
        });
        const applyLink = ensureApplyLink(actionGroup, "desktop");
        actionGroup.appendChild(normalizedLoginLink);
        actionGroup.appendChild(applyLink);
        applyRoutePageHoverEffects(actionGroup);
      }
    }

    if (mobileActionRoot) {
      storeOriginalMarkup(mobileActionRoot);

      const loginLink = Array.from(mobileActionRoot.querySelectorAll("a"))
        .find((link) => normalizePath(link.getAttribute("href")) === "/login");
      // const registerLink = Array.from(mobileActionRoot.querySelectorAll("a"))
      //   .find((link) => normalizePath(link.getAttribute("href")) === "/register");
      const registerLink = Array.from(mobileActionRoot.querySelectorAll("a"))
        .find((link) => normalizePath(link.getAttribute("href")) === "#");      
      // const registerLink = '#';
      let actionGroup = mobileActionRoot.querySelector("[data-ida-actions='mobile']");

      if (!actionGroup) {
        actionGroup = document.createElement("div");
        actionGroup.dataset.idaActions = "mobile";
        actionGroup.className = "header-mobile-action-group ida-home-mobile-actions";
        mobileActionRoot.appendChild(actionGroup);
      }

      if (loginLink) {
        actionGroup.appendChild(ensureActionLink(loginLink, {
          text: "Sign In",
          className: "ida-home-signin",
        }));
      }

      if (registerLink) {
        registerLink.remove();
      }

      actionGroup.appendChild(ensureApplyLink(actionGroup, "mobile"));
      applyRoutePageHoverEffects(actionGroup);
    }

    syncCurrentMenuState(header.querySelector(".ch-menu"));
    syncCurrentMenuState(mobileMenu ? mobileMenu.querySelector(".mobile-nav-menu") : null);
  }

  let lottieScriptPromise = null;
  let leafletAssetsPromise = null;
  let jsVectorMapAssetsPromise = null;

  function ensureLottieScript() {
    if (window.lottie) {
      return Promise.resolve(window.lottie);
    }

    if (lottieScriptPromise) {
      return lottieScriptPromise;
    }

    lottieScriptPromise = new Promise((resolve, reject) => {
      const existingScript = document.querySelector(`script[src="${LOTTIE_SCRIPT_SRC}"]`);

      if (existingScript) {
        existingScript.addEventListener("load", () => resolve(window.lottie), { once: true });
        existingScript.addEventListener("error", reject, { once: true });
        return;
      }

      const script = document.createElement("script");
      script.src = LOTTIE_SCRIPT_SRC;
      script.async = true;
      script.addEventListener("load", () => resolve(window.lottie), { once: true });
      script.addEventListener("error", reject, { once: true });
      document.head.appendChild(script);
    });

    return lottieScriptPromise;
  }

  function ensureExternalStylesheet(href) {
    const existingLink = document.querySelector(`link[href="${href}"]`);

    if (existingLink) {
      return Promise.resolve(existingLink);
    }

    return new Promise((resolve, reject) => {
      const link = document.createElement("link");
      link.rel = "stylesheet";
      link.href = href;
      link.addEventListener("load", () => resolve(link), { once: true });
      link.addEventListener("error", reject, { once: true });
      document.head.appendChild(link);
    });
  }

  function ensureExternalScript(src, globalKey = "") {
    const existingScript = document.querySelector(`script[src="${src}"]`);

    if (existingScript) {
      return new Promise((resolve, reject) => {
        if (!globalKey || window[globalKey]) {
          resolve(window[globalKey] || existingScript);
          return;
        }

        existingScript.addEventListener("load", () => resolve(window[globalKey] || existingScript), { once: true });
        existingScript.addEventListener("error", reject, { once: true });
      });
    }

    return new Promise((resolve, reject) => {
      const script = document.createElement("script");
      script.src = src;
      script.async = true;
      script.addEventListener("load", () => resolve(window[globalKey] || script), { once: true });
      script.addEventListener("error", reject, { once: true });
      document.head.appendChild(script);
    });
  }

  function ensureLeafletAssets() {
    if (window.L) {
      return Promise.resolve(window.L);
    }

    if (leafletAssetsPromise) {
      return leafletAssetsPromise;
    }

    leafletAssetsPromise = Promise.all([
      ensureExternalStylesheet(LEAFLET_STYLESHEET_SRC),
      new Promise((resolve, reject) => {
        const existingScript = document.querySelector(`script[src="${LEAFLET_SCRIPT_SRC}"]`);

        if (existingScript) {
          existingScript.addEventListener("load", () => resolve(window.L), { once: true });
          existingScript.addEventListener("error", reject, { once: true });
          return;
        }

        const script = document.createElement("script");
        script.src = LEAFLET_SCRIPT_SRC;
        script.async = true;
        script.addEventListener("load", () => resolve(window.L), { once: true });
        script.addEventListener("error", reject, { once: true });
        document.head.appendChild(script);
      }),
    ]).then(([, leaflet]) => leaflet || window.L);

    return leafletAssetsPromise;
  }

  function ensureJsVectorMapAssets() {
    if (window.jsVectorMap && window.jsVectorMap.maps && window.jsVectorMap.maps.world) {
      return Promise.resolve(window.jsVectorMap);
    }

    if (jsVectorMapAssetsPromise) {
      return jsVectorMapAssetsPromise;
    }

    jsVectorMapAssetsPromise = Promise.all([
      ensureExternalStylesheet(JSVECTORMAP_STYLESHEET_SRC),
      ensureExternalScript(JSVECTORMAP_SCRIPT_SRC, "jsVectorMap"),
      ensureExternalScript(JSVECTORMAP_WORLD_MAP_SRC),
    ]).then(() => window.jsVectorMap);

    return jsVectorMapAssetsPromise;
  }

  function applyLottieColorMap(container, colorMap) {
    const entries = Object.entries(colorMap || {});

    if (!entries.length) {
      return;
    }

    ["fill", "stroke"].forEach((attribute) => {
      container.querySelectorAll(`[${attribute}]`).forEach((node) => {
        const currentColor = node.getAttribute(attribute);

        if (!currentColor || currentColor.toLowerCase() === "none") {
          return;
        }

        const match = entries.find(([sourceColor]) => colorsAreClose(currentColor, sourceColor));

        if (match) {
          node.setAttribute(attribute, match[1]);
        }
      });
    });
  }

  function applyVisibilityLottieTheme(container) {
    const svg = container.querySelector("svg");

    if (!svg) {
      return false;
    }

    const paths = Array.from(svg.querySelectorAll("path[fill]"));

    if (paths.length < 4) {
      return false;
    }

    const graphic = container.closest(".ida-benefits-card-graphic--visibility");
    const styles = window.getComputedStyle(graphic || container);
    const accentColor = styles.getPropertyValue("--ida-benefits-visibility-fill").trim() || "#ff5528";
    const highlightColor = styles.getPropertyValue("--ida-benefits-visibility-center-ring").trim() || "#ffffff";
    const [backgroundPath, eyePath, ringPath, pupilPath] = paths;

    backgroundPath.setAttribute("fill", "none");
    backgroundPath.setAttribute("stroke", "none");
    backgroundPath.setAttribute("fill-opacity", "0");
    eyePath.setAttribute("fill", accentColor);
    ringPath.setAttribute("fill", highlightColor);
    pupilPath.setAttribute("fill", accentColor);

    return true;
  }

  function tintOfferLottie(container) {
    if (container.dataset.idaLottieTheme === "source") {
      return;
    }

    const modifier = container.dataset.idaLottieModifier
      || Array.from(container.classList).find((className) => className.startsWith("ida-benefits-lottie--"))
        ?.replace("ida-benefits-lottie--", "")
      || Array.from(container.classList).find((className) => className.startsWith("ida-offers-lottie--"))
        ?.replace("ida-offers-lottie--", "");

    if (!modifier) {
      return;
    }

    if (modifier === "visibility" && applyVisibilityLottieTheme(container)) {
      return;
    }

    const colorMapByModifier = {
      visibility: {
        "#553566": "#ff5528",
        "#885a8a": "#ffa269",
        "#d46bca": "none",
        "#d46bcb": "none",
      },
      connection: {
        "#000000": "#ff5528",
      },
      knowledge: {
        "#000000": "#ff5528",
      },
      collaboration: {
        "#000000": "#ff5528",
      },
      positioning: {
        "#000000": "#ff5528",
      },
      structured: {
        "#455a64": "#ffd269",
        "#607d8b": "#ffc94d",
        "#ffa726": "#c75b3e",
        "#ffb74d": "#ff5528",
      },
      digital: {
        "#00bcd4": "#6ca1cb",
        "#1976d2": "#ff5528",
        "#42a5f5": "#c75b3e",
      },
      collaborative: {
        "#ff7f74": "#ff5528",
      },
      global: {
        "#00b3d7": "#ff5528",
        "#3dd9eb": "#ff5528",
      },
    };

    const colorMap = colorMapByModifier[modifier];

    if (colorMap) {
      applyLottieColorMap(container, colorMap);
      return;
    }

  }

  function initOfferLotties() {
    const containers = Array.from(document.querySelectorAll("[data-ida-lottie]"))
      .filter((container) => {
        const state = container.dataset.idaLottieReady;
        return state !== "true" && state !== "pending";
      });

    if (!containers.length) {
      return;
    }

    containers.forEach((container) => {
      container.dataset.idaLottieReady = "pending";
    });

    ensureLottieScript()
      .then((lottie) => {
        containers.forEach((container) => {
          container.dataset.idaLottieReady = "true";

          if (container._idaLottieAnimation) {
            container._idaLottieAnimation.destroy();
            container._idaLottieAnimation = null;
          }

          container.replaceChildren();

          const animation = lottie.loadAnimation({
            container,
            renderer: "svg",
            loop: true,
            autoplay: true,
            path: container.dataset.idaLottie,
            rendererSettings: {
              preserveAspectRatio: "xMidYMid meet",
            },
          });
          container._idaLottieAnimation = animation;

          if (container.dataset.idaLottieTheme !== "source") {
            animation.addEventListener("DOMLoaded", () => {
              tintOfferLottie(container);
            });
            animation.addEventListener("enterFrame", () => {
              tintOfferLottie(container);
            });
          }
        });
      })
      .catch(() => {
        containers.forEach((container) => {
          if (container.dataset.idaLottieReady === "pending") {
            container.dataset.idaLottieReady = "error";
          }
        });
      });
  }

  function hideOriginalSections() {
    HIDE_SELECTORS.forEach((selector) => {
      const element = document.querySelector(selector);

      if (element) {
        element.classList.add("ida-home-hidden-original");
      }
    });
  }

  function revealOriginalSections() {
    HIDE_SELECTORS.forEach((selector) => {
      document.querySelectorAll(selector).forEach((element) => {
        element.classList.remove("ida-home-hidden-original");
      });
    });
  }

  function initHero() {
    const sectionsRoot = document.querySelector("[data-ida-homepage-sections]");

    if (!sectionsRoot || sectionsRoot.dataset.idaHeroReady === "true") {
      return;
    }

    sectionsRoot.dataset.idaHeroReady = "true";

    const videos = Array.from(sectionsRoot.querySelectorAll("[data-ida-hero-video]"));

    function ensureVideoPlaying() {
      videos.forEach((video) => {
        const tryPlay = () => {
          video.playbackRate = 1;
          video.defaultPlaybackRate = 1;

          if (video.paused) {
            const playback = video.play();

            if (playback && typeof playback.catch === "function") {
              playback.catch(() => {});
            }
          }
        };

        video.muted = true;
        video.defaultMuted = true;
        video.playsInline = true;
        video.autoplay = true;
        video.loop = true;
        video.playbackRate = 1;
        video.defaultPlaybackRate = 1;
        video.setAttribute("muted", "");
        video.setAttribute("playsinline", "");
        video.setAttribute("webkit-playsinline", "");

        if (video.dataset.idaHeroPlaybackBound !== "true") {
          video.dataset.idaHeroPlaybackBound = "true";
          video.addEventListener("canplay", tryPlay);
          video.addEventListener("loadeddata", tryPlay);
          video.addEventListener("ended", () => {
            video.currentTime = 0;
            tryPlay();
          });
          video.addEventListener("ratechange", () => {
            if (video.playbackRate !== 1) {
              video.playbackRate = 1;
            }
          });
        }

        tryPlay();
      });
    }

    ensureVideoPlaying();
    destroyHero = null;
  }

  function initImpactCounters() {
    const section = document.querySelector("[data-ida-impact-section]");

    if (!section || section.dataset.idaCounted === "true") {
      return;
    }

    const counters = Array.from(section.querySelectorAll("[data-count-to]"));

    if (!counters.length) {
      return;
    }

    section.dataset.idaCounted = "true";

    const startCounting = () => {
      counters.forEach((counter) => {
        const target = Number(counter.dataset.countTo || "0");
        const startedAt = performance.now();
        const duration = 1400;

        function step(timestamp) {
          const progress = Math.min((timestamp - startedAt) / duration, 1);
          counter.textContent = String(Math.round(target * progress));

          if (progress < 1) {
            requestAnimationFrame(step);
          } else {
            counter.textContent = String(target);
          }
        }

        requestAnimationFrame(step);
      });
    };

    if (!("IntersectionObserver" in window)) {
      startCounting();
      return;
    }

    const observer = new IntersectionObserver((entries) => {
      if (entries.some((entry) => entry.isIntersecting)) {
        observer.disconnect();
        startCounting();
      }
    }, { threshold: 0.35 });

    observer.observe(section);
  }

  function initAudienceSlider() {
    const section = document.querySelector(".ida-audience-section");

    if (!section || section.dataset.idaAudienceReady === "true") {
      return;
    }

    section.dataset.idaAudienceReady = "true";

    const cards = Array.from(section.querySelectorAll("[data-ida-audience-card]"));
    const track = section.querySelector(".ida-audience-track");
    const stage = section.querySelector(".ida-audience-stage");

    if (!track || !stage || cards.length !== AUDIENCE_FRAME_SLOTS.length) {
      return;
    }

    let activeIndex = AUDIENCE_INITIAL_ACTIVE_INDEX;
    let autoplayId = 0;
    let animationTimeoutId = 0;
    let isAnimating = false;
    let layoutFrameId = 0;
    let resizeObserver = null;
    const mobileLayoutQuery = window.matchMedia("(max-width: 767px)");
    const audienceResponsiveVars = [
      "--ida-audience-band-extra",
      "--ida-audience-band-height",
      "--ida-audience-band-top",
      "--ida-audience-band-pad-top",
      "--ida-audience-band-pad-bottom",
      "--ida-audience-left-gap",
      "--ida-audience-edge-gap",
      "--ida-audience-exit-gap",
      "--ida-audience-hidden-gap",
      "--ida-audience-stage-height",
      "--ida-audience-stage-bottom-pad",
      "--ida-audience-hidden-card-width",
      "--ida-audience-hidden-card-height",
      "--ida-audience-hidden-title-width",
      "--ida-audience-exit-card-width",
      "--ida-audience-exit-card-height",
      "--ida-audience-exit-title-width",
      "--ida-audience-edge-card-width",
      "--ida-audience-edge-card-height",
      "--ida-audience-edge-title-width",
      "--ida-audience-side-card-width",
      "--ida-audience-side-card-height",
      "--ida-audience-side-title-width",
      "--ida-audience-active-card-width",
      "--ida-audience-active-card-height",
      "--ida-audience-active-title-width",
    ];

    function clampValue(value, min, max) {
      return Math.min(max, Math.max(min, value));
    }

    function setResponsiveVar(name, value) {
      section.style.setProperty(name, `${Math.round(value)}px`);
    }

    function clearResponsiveVars() {
      audienceResponsiveVars.forEach((name) => {
        section.style.removeProperty(name);
      });
    }

    function syncAudienceLayout() {
      layoutFrameId = 0;

      if (mobileLayoutQuery.matches) {
        clearResponsiveVars();
        return;
      }

      const stageWidth = Math.max(stage.clientWidth, track.clientWidth, 0);

      if (!stageWidth) {
        return;
      }

      const bandExtra = clampValue(stageWidth * 0.112, 148, 228);
      const bandHeight = clampValue(stageWidth * 0.168, 164, 214);
      const bandTop = clampValue(stageWidth * 0.019, 18, 30);
      const bandPadTop = clampValue(stageWidth * 0.034, 28, 42);
      const bandPadBottom = clampValue(stageWidth * 0.104, 96, 128);
      const bottomPad = clampValue(stageWidth * 0.014, 14, 20);

      const activeWidth = clampValue(stageWidth * 0.23, 232, 284);
      const activeHeight = clampValue(activeWidth, 232, 284);
      const sideWidth = clampValue(activeWidth * 0.92, 214, 264);
      const sideHeight = clampValue(sideWidth, 214, 264);
      const edgeWidth = clampValue(activeWidth * 0.77, 178, 218);
      const edgeHeight = clampValue(edgeWidth, 178, 218);
      const exitWidth = clampValue(activeWidth * 0.77, 178, 218);
      const exitHeight = clampValue(exitWidth, 178, 218);

      const leftGap = clampValue(stageWidth * 0.242, activeWidth * 0.95, 468);
      const edgeGap = clampValue(stageWidth * 0.438, leftGap + sideWidth * 0.78, 612);
      const exitGap = clampValue(stageWidth * 0.438, leftGap + sideWidth * 0.78, 612);
      const hiddenGap = clampValue(stageWidth * 0.608, exitGap + exitWidth * 0.72, 824);

      setResponsiveVar("--ida-audience-band-extra", bandExtra);
      setResponsiveVar("--ida-audience-band-height", bandHeight);
      setResponsiveVar("--ida-audience-band-top", bandTop);
      setResponsiveVar("--ida-audience-band-pad-top", bandPadTop);
      setResponsiveVar("--ida-audience-band-pad-bottom", bandPadBottom);
      setResponsiveVar("--ida-audience-stage-bottom-pad", bottomPad);
      setResponsiveVar("--ida-audience-left-gap", leftGap);
      setResponsiveVar("--ida-audience-edge-gap", edgeGap);
      setResponsiveVar("--ida-audience-exit-gap", exitGap);
      setResponsiveVar("--ida-audience-hidden-gap", hiddenGap);
      setResponsiveVar("--ida-audience-hidden-card-width", clampValue(exitWidth - 34, 132, 174));
      setResponsiveVar("--ida-audience-hidden-card-height", clampValue(exitHeight - 34, 132, 174));
      setResponsiveVar("--ida-audience-hidden-title-width", clampValue(exitWidth + 8, 186, 214));
      setResponsiveVar("--ida-audience-exit-card-width", exitWidth);
      setResponsiveVar("--ida-audience-exit-card-height", exitHeight);
      setResponsiveVar("--ida-audience-exit-title-width", clampValue(exitWidth + 18, 214, 242));
      setResponsiveVar("--ida-audience-edge-card-width", edgeWidth);
      setResponsiveVar("--ida-audience-edge-card-height", edgeHeight);
      setResponsiveVar("--ida-audience-edge-title-width", clampValue(edgeWidth + 18, 214, 242));
      setResponsiveVar("--ida-audience-side-card-width", sideWidth);
      setResponsiveVar("--ida-audience-side-card-height", sideHeight);
      setResponsiveVar("--ida-audience-side-title-width", clampValue(sideWidth + 18, 286, 316));
      setResponsiveVar("--ida-audience-active-card-width", activeWidth);
      setResponsiveVar("--ida-audience-active-card-height", activeHeight);
      setResponsiveVar("--ida-audience-active-title-width", clampValue(activeWidth + 28, 330, 364));

      const stageRect = stage.getBoundingClientRect();
      const visibleCards = cards.filter((card) => !card.classList.contains("is-hidden-left"));
      const maxBottom = visibleCards.reduce((maxValue, card) => {
        const rect = card.getBoundingClientRect();
        return Math.max(maxValue, rect.bottom - stageRect.top);
      }, bandTop + bandHeight + bandPadBottom);
      const stageHeight = Math.max(
        Math.ceil(maxBottom + bottomPad),
        Math.ceil(bandTop + bandHeight + bandPadBottom + bottomPad + 8)
      );

      setResponsiveVar("--ida-audience-stage-height", stageHeight);
    }

    function scheduleAudienceLayoutSync() {
      if (layoutFrameId) {
        return;
      }

      layoutFrameId = window.requestAnimationFrame(syncAudienceLayout);
    }

    function normalizeItemIndex(index) {
      return ((index % AUDIENCE_ITEMS.length) + AUDIENCE_ITEMS.length) % AUDIENCE_ITEMS.length;
    }

    function resetSlotClasses(card) {
      Object.values(AUDIENCE_SLOT_CLASSES).forEach((className) => {
        card.classList.remove(className);
      });
    }

    function applySlot(card, slot) {
      resetSlotClasses(card);
      card.dataset.idaSlot = String(slot);

      const slotClass = AUDIENCE_SLOT_CLASSES[String(slot)];

      if (slotClass) {
        card.classList.add(slotClass);
      }

      card.setAttribute("aria-hidden", slot === 0 ? "false" : "true");
    }

    function updateCardContent(card, itemIndex) {
      const item = getAudienceItem(itemIndex);

      card.dataset.idaAudienceIndex = String(itemIndex);
      card.innerHTML = `
        <figure class="ida-audience-card-figure">
          <img src="${item.src}" alt="${item.title}" loading="lazy">
        </figure>
        <h3 class="ida-audience-card-title">${item.title}</h3>`;
    }

    function runWithoutTransition(card, callback) {
      card.classList.add("is-no-transition");
      callback();
      void card.offsetHeight;
      card.classList.remove("is-no-transition");
    }

    function stopAnimationTimeout() {
      if (animationTimeoutId) {
        window.clearTimeout(animationTimeoutId);
        animationTimeoutId = 0;
      }
    }

    function syncFrameWindow() {
      cards.forEach((card, frameIndex) => {
        const slot = AUDIENCE_FRAME_SLOTS[frameIndex];
        const itemIndex = normalizeItemIndex(activeIndex + slot);

        runWithoutTransition(card, () => {
          updateCardContent(card, itemIndex);
          applySlot(card, slot);
        });
      });

      scheduleAudienceLayoutSync();
    }

    function stepForward() {
      if (isAnimating) {
        return;
      }

      isAnimating = true;
      track.classList.add("is-animating");

      window.requestAnimationFrame(() => {
        cards.forEach((card) => {
          applySlot(card, Number(card.dataset.idaSlot || "0") - 1);
        });
      });

      stopAnimationTimeout();
      animationTimeoutId = window.setTimeout(() => {
        animationTimeoutId = 0;
        activeIndex = normalizeItemIndex(activeIndex + 1);

        const recycledCard = cards.find((card) => Number(card.dataset.idaSlot || "0") === -3);

        if (recycledCard) {
          runWithoutTransition(recycledCard, () => {
            updateCardContent(recycledCard, normalizeItemIndex(activeIndex + 3));
            applySlot(recycledCard, 3);
          });
        }

        track.classList.remove("is-animating");
        isAnimating = false;
        scheduleAudienceLayoutSync();
      }, AUDIENCE_TRANSITION_MS);
    }

    function moveToItem(targetIndex) {
      const normalizedTarget = normalizeItemIndex(targetIndex);
      const steps = (normalizedTarget - activeIndex + AUDIENCE_ITEMS.length) % AUDIENCE_ITEMS.length;

      if (!steps || isAnimating) {
        return;
      }

      let completedSteps = 0;

      function advance() {
        stepForward();
        completedSteps += 1;

        if (completedSteps < steps) {
          window.setTimeout(advance, AUDIENCE_TRANSITION_MS + 24);
        }
      }

      advance();
    }

    function stopAutoplay() {
      if (autoplayId) {
        window.clearInterval(autoplayId);
        autoplayId = 0;
      }
    }

    function startAutoplay() {
      stopAutoplay();
      autoplayId = window.setInterval(() => {
        stepForward();
      }, AUDIENCE_AUTOPLAY_MS);
    }

    cards.forEach((card) => {
      card.addEventListener("click", () => {
        const cardIndex = Number(card.dataset.idaAudienceIndex || 0);
        moveToItem(cardIndex);
        startAutoplay();
      });
    });

    track.addEventListener("mouseenter", stopAutoplay);
    track.addEventListener("mouseleave", startAutoplay);
    track.addEventListener("focusin", stopAutoplay);
    track.addEventListener("focusout", startAutoplay);

    if ("ResizeObserver" in window) {
      resizeObserver = new ResizeObserver(() => {
        scheduleAudienceLayoutSync();
      });
      resizeObserver.observe(stage);
    }

    window.addEventListener("resize", scheduleAudienceLayoutSync);

    syncFrameWindow();
    startAutoplay();

    destroyAudienceSlider = () => {
      stopAutoplay();
      stopAnimationTimeout();
      isAnimating = false;

      if (layoutFrameId) {
        window.cancelAnimationFrame(layoutFrameId);
        layoutFrameId = 0;
      }

      if (resizeObserver) {
        resizeObserver.disconnect();
        resizeObserver = null;
      }

      window.removeEventListener("resize", scheduleAudienceLayoutSync);
    };
  }

  function initMembershipKeywordBurst() {
    const section = document.querySelector("[data-ida-membership-eligibility]");

    if (!section || section.dataset.idaMembershipBurstReady === "true") {
      return;
    }

    section.dataset.idaMembershipBurstReady = "true";

    const activate = () => {
      section.classList.add("is-visible");
    };

    if (!("IntersectionObserver" in window)) {
      activate();
      destroyMembershipKeywordBurst = null;
      return;
    }

    const observer = new IntersectionObserver((entries) => {
      if (entries.some((entry) => entry.isIntersecting)) {
        activate();
        observer.disconnect();
      }
    }, { threshold: 0.3 });

    observer.observe(section);

    destroyMembershipKeywordBurst = () => {
      observer.disconnect();
    };
  }

  function parseColorValue(value) {
    if (!value) {
      return null;
    }

    const normalized = value.trim().toLowerCase();

    if (normalized === "transparent") {
      return { r: 0, g: 0, b: 0, a: 0 };
    }

    // Hex color (#rgb, #rrggbb), with optional alpha
    const hexMatch = normalized.match(/^#([\da-f]{3,8})$/);
    if (hexMatch) {
      const h = hexMatch[1];
      let r, g, b;
      if (h.length === 3) {
        r = parseInt(h.charAt(0) + h.charAt(0), 16);
        g = parseInt(h.charAt(1) + h.charAt(1), 16);
        b = parseInt(h.charAt(2) + h.charAt(2), 16);
      } else if (h.length === 6) {
        r = parseInt(h.substring(0, 2), 16);
        g = parseInt(h.substring(2, 4), 16);
        b = parseInt(h.substring(4, 6), 16);
      } else if (h.length === 8) {
        r = parseInt(h.substring(0, 2), 16);
        g = parseInt(h.substring(2, 4), 16);
        b = parseInt(h.substring(4, 6), 16);
        // alpha is h.substring(6, 8) but we ignore it for color matching
      } else {
        return null;
      }
      return { r, g, b, a: 1 };
    }

    const match = normalized.match(/^rgba?\(([^)]+)\)$/);

    if (!match) {
      return null;
    }

    const parts = match[1].split(",").map((part) => part.trim());
    const red = Number.parseFloat(parts[0]);
    const green = Number.parseFloat(parts[1]);
    const blue = Number.parseFloat(parts[2]);
    const alpha = parts.length > 3 ? Number.parseFloat(parts[3]) : 1;

    if ([red, green, blue, alpha].some((channel) => Number.isNaN(channel))) {
      return null;
    }

    return { r: red, g: green, b: blue, a: alpha };
  }

  function isVisibleColor(value) {
    const parsed = parseColorValue(value);
    return Boolean(parsed && parsed.a > 0.04);
  }

  function colorDistance(firstValue, secondValue) {
    const first = parseColorValue(firstValue);
    const second = parseColorValue(secondValue);

    if (!first || !second) {
      return Number.POSITIVE_INFINITY;
    }

    return Math.sqrt(
      ((first.r - second.r) ** 2)
      + ((first.g - second.g) ** 2)
      + ((first.b - second.b) ** 2)
    );
  }

  function colorsAreClose(firstValue, secondValue) {
    return colorDistance(firstValue, secondValue) < 28;
  }

  function isNearWhiteColor(value) {
    return colorDistance(value, "rgb(255, 255, 255)") < 42;
  }

  function getReadableTextColor(backgroundColor) {
    const parsed = parseColorValue(backgroundColor);

    if (!parsed) {
      return "#ffffff";
    }

    const [red, green, blue] = [parsed.r, parsed.g, parsed.b].map((channel) => {
      const srgb = channel / 255;
      return srgb <= 0.03928
        ? srgb / 12.92
        : ((srgb + 0.055) / 1.055) ** 2.4;
    });
    const luminance = (0.2126 * red) + (0.7152 * green) + (0.0722 * blue);

    return luminance > 0.54 ? "#163042" : "#ffffff";
  }

  function getOpaqueBackgroundColor(style) {
    return isVisibleColor(style.backgroundColor) ? style.backgroundColor : "";
  }

  function getColorAlpha(value) {
    const parsed = parseColorValue(value);
    return parsed ? parsed.a : 0;
  }

  function getVisibleBorderColor(style) {
    const borderWidth = Math.max(
      Number.parseFloat(style.borderTopWidth) || 0,
      Number.parseFloat(style.borderRightWidth) || 0,
      Number.parseFloat(style.borderBottomWidth) || 0,
      Number.parseFloat(style.borderLeftWidth) || 0
    );

    if (!borderWidth) {
      return "";
    }

    return isVisibleColor(style.borderTopColor) ? style.borderTopColor : "";
  }

  function getPreferredHoverAccentColor(backgroundColor, borderColor) {
    const backgroundAlpha = getColorAlpha(backgroundColor);

    if (borderColor && (!backgroundColor || backgroundAlpha < 0.72)) {
      return borderColor;
    }

    if (backgroundColor) {
      return backgroundColor;
    }

    return borderColor;
  }

  function isEligibleHoverControl(control) {
    const rect = control.getBoundingClientRect();
    const area = rect.width * rect.height;

    if (!area || rect.height > 120 || area > 28000) {
      return false;
    }

    return true;
  }

  function applyRoutePageHoverEffects(page) {
    if (!page || page.dataset.idaHoverEffectsReady === "true") {
      return;
    }

    page.dataset.idaHoverEffectsReady = "true";

    page.querySelectorAll("a, button").forEach((control) => {
      if (!isEligibleHoverControl(control)) {
        return;
      }

      const style = window.getComputedStyle(control);
      const backgroundColor = getOpaqueBackgroundColor(style);
      const borderColor = getVisibleBorderColor(style);
      const accentColor = getPreferredHoverAccentColor(backgroundColor, borderColor);
      const hasAccentBackground = backgroundColor && !isNearWhiteColor(backgroundColor);
      const hasOutlineStyle = borderColor && (!backgroundColor || isNearWhiteColor(backgroundColor));

      if (!hasAccentBackground && !hasOutlineStyle) {
        return;
      }

      control.classList.add("ida-route-hover-control");

      if (hasAccentBackground) {
        const hoverTextColor = !isVisibleColor(style.color)
          || isNearWhiteColor(style.color)
          || colorsAreClose(style.color, accentColor)
          ? accentColor
          : style.color;

        control.dataset.idaHoverMode = "filled";
        control.style.setProperty("--ida-route-hover-border", accentColor);
        control.style.setProperty("--ida-route-hover-text", hoverTextColor);
        return;
      }

      const hoverTextColor = colorsAreClose(style.color, borderColor)
        ? getReadableTextColor(borderColor)
        : style.color;

      control.dataset.idaHoverMode = "outlined";
      control.style.setProperty("--ida-route-hover-background", borderColor);
      control.style.setProperty("--ida-route-hover-text", hoverTextColor);
    });
  }

  function initRoutePageSectionReveals(page) {
    if (!page || page.dataset.idaSectionRevealReady === "true") {
      return;
    }

    const sections = Array.from(page.children)
      .filter((child) => child.tagName === "SECTION")
      .slice(1);

    if (!sections.length) {
      page.dataset.idaSectionRevealReady = "true";
      return;
    }

    page.dataset.idaSectionRevealReady = "true";

    sections.forEach((section, index) => {
      section.classList.add("ida-route-reveal-target");
      section.style.setProperty("--ida-route-reveal-delay", `${Math.min(index, 4) * 70}ms`);
    });

    if (
      !("IntersectionObserver" in window)
      || window.matchMedia("(prefers-reduced-motion: reduce)").matches
    ) {
      sections.forEach((section) => {
        section.classList.add("is-visible");
      });
      return;
    }

    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) {
          return;
        }

        entry.target.classList.add("is-visible");
        observer.unobserve(entry.target);
      });
    }, {
      threshold: 0.18,
      rootMargin: "0px 0px -10% 0px",
    });

    sections.forEach((section) => {
      observer.observe(section);
    });

    page._idaSectionRevealObserver = observer;
  }

  function cleanupRoutePageEffects(pageSelector) {
    const page = typeof pageSelector === "string"
      ? document.querySelector(pageSelector)
      : pageSelector;

    if (!page || !page._idaSectionRevealObserver) {
      return;
    }

    page._idaSectionRevealObserver.disconnect();
    page._idaSectionRevealObserver = null;
  }

  function initRoutePageEffects(pageSelector) {
    const page = typeof pageSelector === "string"
      ? document.querySelector(pageSelector)
      : pageSelector;

    if (!page) {
      return;
    }

    initRoutePageSectionReveals(page);
    applyRoutePageHoverEffects(page);
  }

  function hideRouteOriginalContent(pageSelector, selectors) {
    const header = document.querySelector(".ch-header-area, header");
    const footer = document.querySelector(".ch-footer-section, footer");

    if (header && footer && header.parentElement && header.parentElement === footer.parentElement) {
      Array.from(header.parentElement.children).forEach((child) => {
        if (
          child === header ||
          child.matches(pageSelector)
        ) {
          return;
        }

        child.classList.add("ida-route-hidden-original");
      });
    }

    selectors.forEach((selector) => {
      document.querySelectorAll(selector).forEach((element) => {
        if (
          element.matches(pageSelector) ||
          element.closest(pageSelector)
        ) {
          return;
        }

        element.classList.add("ida-route-hidden-original");
      });
    });
  }

  function revealRouteOriginalContent() {
    document.querySelectorAll(".ida-route-hidden-original").forEach((element) => {
      element.classList.remove("ida-route-hidden-original");
    });
  }

  function hideMembershipOriginalContent() {
    hideRouteOriginalContent("[data-ida-membership-page]", MEMBERSHIP_HIDE_SELECTORS);
  }

  function revealMembershipOriginalContent() {
    revealRouteOriginalContent();
  }

  function positionMembershipPage() {
    const injected = document.querySelector("[data-ida-membership-page]");

    if (!injected) {
      return;
    }

    const header = document.querySelector(".ch-header-area, header");
    const root = document.querySelector("#root");
    const footer = document.querySelector(".ch-footer-section, footer");

    if (header && injected.previousElementSibling !== header) {
      header.insertAdjacentElement("afterend", injected);
      return;
    }

    if (!header && footer && injected.nextElementSibling !== footer) {
      footer.insertAdjacentElement("beforebegin", injected);
      return;
    }

    if (!header && !footer && root && injected.parentElement !== root) {
      root.appendChild(injected);
    }
  }

  function injectMembershipPage() {
    const existing = document.querySelector("[data-ida-membership-page]");

    if (existing) {
      positionMembershipPage();
      syncInjectedFooterLogo();
      syncInjectedFooterLinks();
      initRoutePageEffects(existing);
      initMembershipKeywordBurst();
      initBenefitsCarousel();
      initOfferLotties();
      return;
    }

    const footer = document.querySelector(".ch-footer-section, footer");
    const header = document.querySelector(".ch-header-area, header");
    const root = document.querySelector("#root");

    if (footer) {
      footer.insertAdjacentHTML("beforebegin", membershipMarkup());
    } else if (header) {
      header.insertAdjacentHTML("afterend", membershipMarkup());
    } else if (root) {
      root.insertAdjacentHTML("beforeend", membershipMarkup());
    }

    positionMembershipPage();
    syncInjectedFooterLogo();
    syncInjectedFooterLinks();
    initRoutePageEffects("[data-ida-membership-page]");
    initMembershipKeywordBurst();
    initBenefitsCarousel();
    initOfferLotties();
  }

  function initBenefitsCarousel() {
    const section = document.querySelector("[data-ida-benefits-spotlight]");

    if (!section || section.dataset.idaBenefitsReady === "true") {
      return;
    }

    section.dataset.idaBenefitsReady = "true";

    const title = section.querySelector("[data-ida-benefit-title]");
    const copy = section.querySelector("[data-ida-benefit-copy]");
    const stage = section.querySelector("[data-ida-benefit-card-stage]");
    let activeIndex = 0;
    let autoplayId = 0;
    let transitionId = 0;
    let underTransitionId = 0;
    let isAnimating = false;

    function stopAutoplay() {
      if (autoplayId) {
        window.clearTimeout(autoplayId);
        autoplayId = 0;
      }
    }

    function stopTransition() {
      if (transitionId) {
        window.clearTimeout(transitionId);
        transitionId = 0;
      }

      if (underTransitionId) {
        window.clearTimeout(underTransitionId);
        underTransitionId = 0;
      }
    }

    function destroyStageLotties() {
      if (!stage) {
        return;
      }

      stage.querySelectorAll("[data-ida-lottie]").forEach((container) => {
        if (container._idaLottieAnimation) {
          container._idaLottieAnimation.destroy();
          container._idaLottieAnimation = null;
        }
      });
    }

    function renderText(index) {
      const item = getBenefitItem(index);

      if (title) {
        title.textContent = item.title;
        title.dataset.idaBenefitModifier = item.modifier;
      }

      if (copy) {
        copy.textContent = item.copy;
      }

      if (stage) {
        stage.dataset.idaBenefitModifier = item.modifier;
      }
    }

    function renderCards() {
      if (!stage) {
        return;
      }

      destroyStageLotties();
      stage.classList.remove("is-animating");
      stage.innerHTML = Array.from({ length: BENEFITS_CARD_VISIBLE_COUNT }, (_, offset) =>
        buildBenefitsCardMarkup(getBenefitItem(activeIndex + offset), offset),
      ).join("");
      initOfferLotties();
    }

    function render() {
      renderText(activeIndex);
      renderCards();
    }

    function animateToNext(nextIndex) {
      if (!stage) {
        activeIndex = nextIndex;
        render();
        return;
      }

      const cards = Array.from(stage.querySelectorAll("[data-ida-benefit-card]"));

      if (cards.length < BENEFITS_CARD_VISIBLE_COUNT) {
        activeIndex = nextIndex;
        render();
        return;
      }

      const [frontCard, midCard, farCard] = cards;
      isAnimating = true;
      renderText(nextIndex);
      stage.classList.add("is-animating");
      frontCard.classList.remove("ida-benefits-card--front");
      frontCard.classList.add("ida-benefits-card--moving-out");
      midCard.classList.remove("ida-benefits-card--mid");
      midCard.classList.add("ida-benefits-card--moving-front");
      farCard.classList.remove("ida-benefits-card--far");
      farCard.classList.add("ida-benefits-card--moving-mid");

      stopTransition();
      underTransitionId = window.setTimeout(() => {
        underTransitionId = 0;

        if (!frontCard.isConnected) {
          return;
        }

        frontCard.classList.remove("ida-benefits-card--moving-out");
        frontCard.classList.add("ida-benefits-card--moving-under");
      }, BENEFITS_TRANSITION_OUT_MS);

      transitionId = window.setTimeout(() => {
        transitionId = 0;
        activeIndex = nextIndex;
        isAnimating = false;
        render();
        startAutoplay();
      }, BENEFITS_TRANSITION_MS);
    }

    function goTo(index) {
      const nextIndex = ((index % BENEFITS_ITEMS.length) + BENEFITS_ITEMS.length) % BENEFITS_ITEMS.length;

      if (nextIndex === activeIndex || isAnimating) {
        return;
      }

      stopAutoplay();

      if (nextIndex === ((activeIndex + 1) % BENEFITS_ITEMS.length)) {
        animateToNext(nextIndex);
        return;
      }

      activeIndex = nextIndex;
      render();
      startAutoplay();
    }

    function startAutoplay() {
      stopAutoplay();
      autoplayId = window.setTimeout(() => {
        goTo(activeIndex + 1);
      }, BENEFITS_AUTOPLAY_MS);
    }

    render();
    startAutoplay();

    destroyBenefitsCarousel = () => {
      stopAutoplay();
      stopTransition();
      destroyStageLotties();
    };
  }

  function hideEventsOriginalContent() {
    hideRouteOriginalContent("[data-ida-events-page]", EVENTS_HIDE_SELECTORS);
  }

  function revealEventsOriginalContent() {
    revealRouteOriginalContent();
  }

  function positionEventsPage() {
    const injected = document.querySelector("[data-ida-events-page]");

    if (!injected) {
      return;
    }

    const header = document.querySelector(".ch-header-area, header");
    const root = document.querySelector("#root");
    const footer = document.querySelector(".ch-footer-section, footer");

    if (header && injected.previousElementSibling !== header) {
      header.insertAdjacentElement("afterend", injected);
      return;
    }

    if (!header && footer && injected.nextElementSibling !== footer) {
      footer.insertAdjacentElement("beforebegin", injected);
      return;
    }

    if (!header && !footer && root && injected.parentElement !== root) {
      root.appendChild(injected);
    }
  }

  function injectEventsPage() {
    const existing = document.querySelector("[data-ida-events-page]");

    if (existing) {
      positionEventsPage();
      syncInjectedFooterLogo();
      syncInjectedFooterLinks();
      initRoutePageEffects(existing);
      return;
    }

    const footer = document.querySelector(".ch-footer-section, footer");
    const header = document.querySelector(".ch-header-area, header");
    const root = document.querySelector("#root");

    if (footer) {
      footer.insertAdjacentHTML("beforebegin", eventsMarkup());
    } else if (header) {
      header.insertAdjacentHTML("afterend", eventsMarkup());
    } else if (root) {
      root.insertAdjacentHTML("beforeend", eventsMarkup());
    }

    positionEventsPage();
    syncInjectedFooterLogo();
    syncInjectedFooterLinks();
    initRoutePageEffects("[data-ida-events-page]");
  }

  function cleanupEvents() {
    restoreHeader();
    document.body.classList.remove("ida-events-page-active");
    revealEventsOriginalContent();

    const injected = document.querySelector("[data-ida-events-page]");

    if (injected) {
      cleanupRoutePageEffects(injected);
      injected.remove();
    }
  }

  function applyEvents() {
    applyHeader();
    document.body.classList.add("ida-events-page-active");
    hideEventsOriginalContent();
    injectEventsPage();
    initEventsPage();
  }

  function hideCollaborativeProjectsOriginalContent() {
    hideRouteOriginalContent("[data-ida-collaborative-projects-page]", COLLABORATIVE_PROJECTS_HIDE_SELECTORS);
  }

  function revealCollaborativeProjectsOriginalContent() {
    revealRouteOriginalContent();
  }

  function positionCollaborativeProjectsPage() {
    const injected = document.querySelector("[data-ida-collaborative-projects-page]");

    if (!injected) {
      return;
    }

    const header = document.querySelector(".ch-header-area, header");
    const root = document.querySelector("#root");
    const footer = document.querySelector(".ch-footer-section, footer");

    if (header && injected.previousElementSibling !== header) {
      header.insertAdjacentElement("afterend", injected);
      return;
    }

    if (!header && footer && injected.nextElementSibling !== footer) {
      footer.insertAdjacentElement("beforebegin", injected);
      return;
    }

    if (!header && !footer && root && injected.parentElement !== root) {
      root.appendChild(injected);
    }
  }

  function injectCollaborativeProjectsPage() {
    const existing = document.querySelector("[data-ida-collaborative-projects-page]");

    if (existing) {
      positionCollaborativeProjectsPage();
      syncInjectedFooterLogo();
      syncInjectedFooterLinks();
      initRoutePageEffects(existing);
      return;
    }

    const footer = document.querySelector(".ch-footer-section, footer");
    const header = document.querySelector(".ch-header-area, header");
    const root = document.querySelector("#root");

    if (footer) {
      footer.insertAdjacentHTML("beforebegin", collaborativeProjectsMarkup());
    } else if (header) {
      header.insertAdjacentHTML("afterend", collaborativeProjectsMarkup());
    } else if (root) {
      root.insertAdjacentHTML("beforeend", collaborativeProjectsMarkup());
    }

    positionCollaborativeProjectsPage();
    syncInjectedFooterLogo();
    syncInjectedFooterLinks();
    initRoutePageEffects("[data-ida-collaborative-projects-page]");
  }

  function cleanupCollaborativeProjects() {
    restoreHeader();
    document.body.classList.remove("ida-collaborative-projects-page-active");
    revealCollaborativeProjectsOriginalContent();

    const injected = document.querySelector("[data-ida-collaborative-projects-page]");

    if (injected) {
      cleanupRoutePageEffects(injected);
      injected.remove();
    }
  }

  function applyCollaborativeProjects() {
    applyHeader();
    document.body.classList.add("ida-collaborative-projects-page-active");
    hideCollaborativeProjectsOriginalContent();
    injectCollaborativeProjectsPage();
  }

  function hideProjectIdeaSubmissionOriginalContent() {
    hideRouteOriginalContent("[data-ida-project-idea-page]", PROJECT_IDEA_SUBMISSION_HIDE_SELECTORS);
  }

  function revealProjectIdeaSubmissionOriginalContent() {
    revealRouteOriginalContent();
  }

  function positionProjectIdeaSubmissionPage() {
    const injected = document.querySelector("[data-ida-project-idea-page]");

    if (!injected) {
      return;
    }

    const header = document.querySelector(".ch-header-area, header");
    const root = document.querySelector("#root");
    const footer = document.querySelector(".ch-footer-section, footer");

    if (header && injected.previousElementSibling !== header) {
      header.insertAdjacentElement("afterend", injected);
      return;
    }

    if (!header && footer && injected.nextElementSibling !== footer) {
      footer.insertAdjacentElement("beforebegin", injected);
      return;
    }

    if (!header && !footer && root && injected.parentElement !== root) {
      root.appendChild(injected);
    }
  }

  function injectProjectIdeaSubmissionPage() {
    const existing = document.querySelector("[data-ida-project-idea-page]");

    if (existing) {
      positionProjectIdeaSubmissionPage();
      syncInjectedFooterLogo();
      syncInjectedFooterLinks();
      initRoutePageEffects(existing);
      return;
    }

    const footer = document.querySelector(".ch-footer-section, footer");
    const header = document.querySelector(".ch-header-area, header");
    const root = document.querySelector("#root");

    if (footer) {
      footer.insertAdjacentHTML("beforebegin", projectIdeaSubmissionMarkup());
    } else if (header) {
      header.insertAdjacentHTML("afterend", projectIdeaSubmissionMarkup());
    } else if (root) {
      root.insertAdjacentHTML("beforeend", projectIdeaSubmissionMarkup());
    }

    positionProjectIdeaSubmissionPage();
    syncInjectedFooterLogo();
    syncInjectedFooterLinks();
    initRoutePageEffects("[data-ida-project-idea-page]");
  }

  function initGlobalNetworkApplicationPage() {
    const page = document.querySelector("[data-ida-global-network-application-page]");

    if (!page || page.dataset.idaGlobalNetworkApplicationReady === "true") {
      return;
    }

    page.dataset.idaGlobalNetworkApplicationReady = "true";

    const form = page.querySelector("[data-ida-application-form]");
    const panels = form ? Array.from(form.querySelectorAll("[data-ida-application-panel]")) : [];
    const steps = form ? Array.from(form.querySelectorAll("[data-ida-application-step-target]")) : [];
    const previous = form ? form.querySelector("[data-ida-application-prev-step]") : null;
    const next = form ? form.querySelector("[data-ida-application-next-step]") : null;
    const submit = form ? form.querySelector("[data-ida-application-submit-button]") : null;
    const draft = form ? form.querySelector("[data-ida-application-draft-button]") : null;
    const status = form ? form.querySelector("[data-ida-application-status]") : null;
    const countrySelect = form ? form.querySelector("[data-ida-application-country-select]") : null;
    const countryOtherField = form ? form.querySelector("[data-ida-application-country-other-field]") : null;
    const primaryEmail = form ? form.querySelector("[data-ida-application-primary-email]") : null;
    const secondaryEmail = form ? form.querySelector("[data-ida-application-secondary-email]") : null;
    const secondarySameEmail = form ? form.querySelector("[data-ida-application-secondary-same-email]") : null;
    const progressStep = form ? form.querySelector("[data-ida-application-progress-step]") : null;
    const progressPercent = form ? form.querySelector("[data-ida-application-progress-percent]") : null;
    const progressBar = form ? form.querySelector("[data-ida-application-progress-bar]") : null;
    const progressFill = progressBar ? progressBar.querySelector("span") : null;
    let current = 0;

    if (!form || !panels.length || !previous || !next || !submit || !draft) {
      return;
    }

    function setStatus(message = "") {
      if (status) {
        status.textContent = message;
      }
    }

    function scrollFormIntoView() {
      const targetTop = Math.max(form.getBoundingClientRect().top + window.scrollY - 120, 0);
      window.scrollTo({ top: targetTop, behavior: "smooth" });
    }

    function showStep(index) {
      current = Math.max(0, Math.min(index, panels.length - 1));
      const formStep = Math.max(current, 1);
      const formStepCount = Math.max(panels.length - 1, 1);
      const percent = Math.round((formStep / formStepCount) * 100);

      form.classList.toggle("is-welcome-step", current === 0);
      panels.forEach((panel, panelIndex) => {
        panel.classList.toggle("is-active", panelIndex === current);
      });
      steps.forEach((step, stepIndex) => {
        step.setAttribute("aria-current", stepIndex + 1 === current ? "step" : "false");
      });

      previous.disabled = current === 0;
      previous.hidden = current === 0;
      draft.hidden = current === 0;
      next.hidden = current === panels.length - 1;
      submit.hidden = current !== panels.length - 1;
      next.textContent = current === 0 ? "Start application" : "Next";

      if (progressStep) {
        progressStep.textContent = `Step ${formStep} of ${formStepCount}`;
      }

      if (progressPercent) {
        progressPercent.textContent = `${percent}% complete`;
      }

      if (progressBar) {
        progressBar.setAttribute("aria-valuenow", String(percent));
      }

      if (progressFill) {
        progressFill.style.width = `${percent}%`;
      }

      setStatus("");
      scrollFormIntoView();
    }

    function syncCountryOther() {
      if (countrySelect && countryOtherField) {
        countryOtherField.hidden = countrySelect.value !== "Other";
      }
    }

    function syncSecondaryEmail() {
      if (primaryEmail && secondaryEmail && secondarySameEmail && secondarySameEmail.checked) {
        secondaryEmail.value = primaryEmail.value;
      }
    }

    steps.forEach((step) => {
      step.addEventListener("click", () => {
        showStep(Number(step.dataset.idaApplicationStepTarget || 0));
      });
    });

    previous.addEventListener("click", () => showStep(current - 1));
    next.addEventListener("click", () => showStep(current + 1));
    draft.addEventListener("click", () => {
      setStatus("Draft saving will be connected when the backend is added.");
    });
    submit.addEventListener("click", () => {
      setStatus("Submission is not connected yet. This page is currently a front-end preview.");
    });

    if (countrySelect) {
      countrySelect.addEventListener("change", syncCountryOther);
      syncCountryOther();
    }

    if (secondarySameEmail) {
      secondarySameEmail.addEventListener("change", () => {
        if (secondaryEmail) {
          secondaryEmail.readOnly = secondarySameEmail.checked;
        }

        syncSecondaryEmail();
      });
    }

    if (primaryEmail) {
      primaryEmail.addEventListener("input", syncSecondaryEmail);
    }

    if (secondaryEmail && secondarySameEmail) {
      secondaryEmail.readOnly = secondarySameEmail.checked;
    }

    syncSecondaryEmail();
    showStep(0);
  }

  function hideGlobalNetworkApplicationOriginalContent() {
    hideRouteOriginalContent("[data-ida-global-network-application-page]", GLOBAL_NETWORK_APPLICATION_HIDE_SELECTORS);
  }

  function revealGlobalNetworkApplicationOriginalContent() {
    revealRouteOriginalContent();
  }

  function positionGlobalNetworkApplicationPage() {
    const injected = document.querySelector("[data-ida-global-network-application-page]");

    if (!injected) {
      return;
    }

    const header = document.querySelector(".ch-header-area, header");
    const root = document.querySelector("#root");
    const footer = document.querySelector(".ch-footer-section, footer");

    if (header && injected.previousElementSibling !== header) {
      header.insertAdjacentElement("afterend", injected);
      return;
    }

    if (!header && footer && injected.nextElementSibling !== footer) {
      footer.insertAdjacentElement("beforebegin", injected);
      return;
    }

    if (!header && !footer && root && injected.parentElement !== root) {
      root.appendChild(injected);
    }
  }

  function injectGlobalNetworkApplicationPage() {
    const existing = document.querySelector("[data-ida-global-network-application-page]");

    if (existing) {
      positionGlobalNetworkApplicationPage();
      syncInjectedFooterLogo();
      syncInjectedFooterLinks();
      initRoutePageEffects(existing);
      initGlobalNetworkApplicationPage();
      return;
    }

    const footer = document.querySelector(".ch-footer-section, footer");
    const header = document.querySelector(".ch-header-area, header");
    const root = document.querySelector("#root");

    if (footer) {
      footer.insertAdjacentHTML("beforebegin", globalNetworkApplicationMarkup());
    } else if (header) {
      header.insertAdjacentHTML("afterend", globalNetworkApplicationMarkup());
    } else if (root) {
      root.insertAdjacentHTML("beforeend", globalNetworkApplicationMarkup());
    }

    positionGlobalNetworkApplicationPage();
    syncInjectedFooterLogo();
    syncInjectedFooterLinks();
    initRoutePageEffects("[data-ida-global-network-application-page]");
    initGlobalNetworkApplicationPage();
  }

  function cleanupGlobalNetworkApplication() {
    restoreHeader();
    document.body.classList.remove("ida-global-network-application-page-active");
    revealGlobalNetworkApplicationOriginalContent();

    const injected = document.querySelector("[data-ida-global-network-application-page]");

    if (injected) {
      cleanupRoutePageEffects(injected);
      injected.remove();
    }
  }

  function applyGlobalNetworkApplication() {
    applyHeader();
    document.body.classList.add("ida-global-network-application-page-active");
    hideGlobalNetworkApplicationOriginalContent();
    injectGlobalNetworkApplicationPage();
  }

  function cleanupProjectIdeaSubmission() {
    restoreHeader();
    document.body.classList.remove("ida-project-idea-page-active");
    revealProjectIdeaSubmissionOriginalContent();

    const injected = document.querySelector("[data-ida-project-idea-page]");

    if (injected) {
      cleanupRoutePageEffects(injected);
      injected.remove();
    }
  }

  function applyProjectIdeaSubmission() {
    applyHeader();
    document.body.classList.add("ida-project-idea-page-active");
    hideProjectIdeaSubmissionOriginalContent();
    injectProjectIdeaSubmissionPage();
  }

  function hideNewsSpotlightOriginalContent() {
    hideRouteOriginalContent("[data-ida-news-spotlight-page]", NEWS_SPOTLIGHT_HIDE_SELECTORS);
  }

  function revealNewsSpotlightOriginalContent() {
    revealRouteOriginalContent();
  }

  function positionNewsSpotlightPage() {
    const injected = document.querySelector("[data-ida-news-spotlight-page]");

    if (!injected) {
      return;
    }

    const header = document.querySelector(".ch-header-area, header");
    const root = document.querySelector("#root");
    const footer = document.querySelector(".ch-footer-section, footer");

    if (header && injected.previousElementSibling !== header) {
      header.insertAdjacentElement("afterend", injected);
      return;
    }

    if (!header && footer && injected.nextElementSibling !== footer) {
      footer.insertAdjacentElement("beforebegin", injected);
      return;
    }

    if (!header && !footer && root && injected.parentElement !== root) {
      root.appendChild(injected);
    }
  }

  function injectNewsSpotlightPage() {
    const existing = document.querySelector("[data-ida-news-spotlight-page]");

    if (existing) {
      positionNewsSpotlightPage();
      syncInjectedFooterLogo();
      syncInjectedFooterLinks();
      initRoutePageEffects(existing);
      return;
    }

    const footer = document.querySelector(".ch-footer-section, footer");
    const header = document.querySelector(".ch-header-area, header");
    const root = document.querySelector("#root");

    if (footer) {
      footer.insertAdjacentHTML("beforebegin", newsSpotlightMarkup());
    } else if (header) {
      header.insertAdjacentHTML("afterend", newsSpotlightMarkup());
    } else if (root) {
      root.insertAdjacentHTML("beforeend", newsSpotlightMarkup());
    }

    positionNewsSpotlightPage();
    syncInjectedFooterLogo();
    syncInjectedFooterLinks();
    initRoutePageEffects("[data-ida-news-spotlight-page]");
  }

  function cleanupNewsSpotlight() {
    restoreHeader();
    document.body.classList.remove("ida-news-spotlight-page-active");
    revealNewsSpotlightOriginalContent();

    const injected = document.querySelector("[data-ida-news-spotlight-page]");

    if (injected) {
      cleanupRoutePageEffects(injected);
      injected.remove();
    }
  }

  function applyNewsSpotlight() {
    applyHeader();
    document.body.classList.add("ida-news-spotlight-page-active");
    hideNewsSpotlightOriginalContent();
    injectNewsSpotlightPage();
  }

  function hideContactOriginalContent() {
    hideRouteOriginalContent("[data-ida-contact-page]", CONTACT_HIDE_SELECTORS);
  }

  function revealContactOriginalContent() {
    revealRouteOriginalContent();
  }

  function positionContactPage() {
    const injected = document.querySelector("[data-ida-contact-page]");

    if (!injected) {
      return;
    }

    const header = document.querySelector(".ch-header-area, header");
    const root = document.querySelector("#root");
    const footer = document.querySelector(".ch-footer-section, footer");

    if (header && injected.previousElementSibling !== header) {
      header.insertAdjacentElement("afterend", injected);
      return;
    }

    if (!header && footer && injected.nextElementSibling !== footer) {
      footer.insertAdjacentElement("beforebegin", injected);
      return;
    }

    if (!header && !footer && root && injected.parentElement !== root) {
      root.appendChild(injected);
    }
  }

  function injectContactPage() {
    const existing = document.querySelector("[data-ida-contact-page]");

    if (existing) {
      positionContactPage();
      syncInjectedFooterLogo();
      syncInjectedFooterLinks();
      initRoutePageEffects(existing);
      initContactPage();
      return;
    }

    const footer = document.querySelector(".ch-footer-section, footer");
    const header = document.querySelector(".ch-header-area, header");
    const root = document.querySelector("#root");

    if (footer) {
      footer.insertAdjacentHTML("beforebegin", contactMarkup());
    } else if (header) {
      header.insertAdjacentHTML("afterend", contactMarkup());
    } else if (root) {
      root.insertAdjacentHTML("beforeend", contactMarkup());
    }

    positionContactPage();
    syncInjectedFooterLogo();
    syncInjectedFooterLinks();
    initRoutePageEffects("[data-ida-contact-page]");
    initContactPage();
  }

  function cleanupContact() {
    restoreHeader();
    document.body.classList.remove("ida-contact-page-active");
    revealContactOriginalContent();

    const injected = document.querySelector("[data-ida-contact-page]");

    if (injected) {
      cleanupRoutePageEffects(injected);
      injected.remove();
    }
  }

  function applyContact() {
    applyHeader();
    document.body.classList.add("ida-contact-page-active");
    hideContactOriginalContent();
    injectContactPage();
  }

  function initEventsPage() {
    const page = document.querySelector("[data-ida-events-page]");

    if (!page || page.dataset.idaEventsReady === "true") {
      return;
    }

    page.dataset.idaEventsReady = "true";

    const moreButton = page.querySelector("[data-ida-events-more]");
    const hiddenItems = Array.from(page.querySelectorAll("[data-ida-events-item][hidden]"));

    if (!moreButton) {
      return;
    }

    if (!hiddenItems.length) {
      moreButton.hidden = true;
      return;
    }

    moreButton.addEventListener("click", () => {
      hiddenItems.forEach((item) => {
        item.hidden = false;
      });
      moreButton.hidden = true;
    });
  }

  function initDirectoryMap() {
    const page = document.querySelector("[data-ida-directory-page]");

    if (!page || page.dataset.idaDirectoryReady === "true") {
      return;
    }

    page.dataset.idaDirectoryReady = "true";

    const detailImage = page.querySelector("[data-ida-directory-image]");
    const detailName = page.querySelector("[data-ida-directory-name]");
    const detailTier = page.querySelector("[data-ida-directory-tier]");
    const detailAddress = page.querySelector("[data-ida-directory-address]");
    const detailDescription = page.querySelector("[data-ida-directory-description]");
    const detailMeta = page.querySelector(".ida-directory-info-meta");
    const detailContact = page.querySelector(".ida-directory-info-contact");
    const detailPhone = page.querySelector("[data-ida-directory-phone]");
    const detailEmail = page.querySelector("[data-ida-directory-email]");
    const detailWebsite = page.querySelector("[data-ida-directory-website]");
    const detailSocialLinks = page.querySelector("[data-ida-directory-social-links]");
    const detailPhoneRow = page.querySelector("[data-ida-directory-phone-row]");
    const detailEmailRow = page.querySelector("[data-ida-directory-email-row]");
    const detailWebsiteRow = page.querySelector("[data-ida-directory-website-row]");
    const detailSocialRow = page.querySelector("[data-ida-directory-social-row]");
    const panel = page.querySelector("[data-ida-directory-panel]");
    const emptyState = page.querySelector("[data-ida-directory-empty]");
    const contentState = page.querySelector("[data-ida-directory-content]");
    const jumpButton = page.querySelector("[data-ida-directory-jump]");
    const mapSection = page.querySelector("[data-ida-directory-map]");
    const mapMount = page.querySelector("[data-ida-directory-vector-map]");
    const controls = Array.from(page.querySelectorAll("[data-ida-directory-select]"));
    const membersById = new Map(DIRECTORY_MEMBERS.map((member) => [member.id, member]));
    const memberIdsByRegionCode = DIRECTORY_MEMBERS.reduce((regionMap, member) => {
      const regionCode = (member.regionCode || "").toUpperCase();

      if (!regionCode) {
        return regionMap;
      }

      const existing = regionMap.get(regionCode) || [];
      existing.push(member.id);
      regionMap.set(regionCode, existing);
      return regionMap;
    }, new Map());
    const mappableMembers = DIRECTORY_MEMBERS
      .filter((member) => Number.isFinite(member.lat) && Number.isFinite(member.lng));
    const markerIndexesById = new Map(
      mappableMembers.map((member, index) => [member.id, index])
    );
    let activeMemberId = "";
    let directoryVectorMap = null;
    let directoryMapReady = false;
    let destroyed = false;

    function getMemberIdsForRegion(regionCode) {
      return memberIdsByRegionCode.get((regionCode || "").toUpperCase()) || [];
    }

    // Some countries can legitimately have multiple member records.
    function getNextMemberIdForRegion(regionCode) {
      const memberIds = getMemberIdsForRegion(regionCode);

      if (!memberIds.length) {
        return "";
      }

      const normalizedRegionCode = (regionCode || "").toUpperCase();
      const activeMember = activeMemberId ? membersById.get(activeMemberId) : null;
      const activeRegionCode = (activeMember?.regionCode || "").toUpperCase();

      if (activeRegionCode !== normalizedRegionCode) {
        return memberIds[0];
      }

      const activeIndex = memberIds.indexOf(activeMemberId);

      if (activeIndex === -1) {
        return memberIds[0];
      }

      return memberIds[(activeIndex + 1) % memberIds.length];
    }

    function clearLink(link) {
      if (!link) {
        return;
      }

      link.textContent = "";
      link.removeAttribute("href");
    }

    function setLink(link, value, href) {
      if (!link) {
        return;
      }

      link.textContent = value || "";

      if (href) {
        link.href = href;
      } else {
        link.removeAttribute("href");
      }
    }

    function syncActiveState(selectedId) {
      controls.forEach((control) => {
        const isActive = control.dataset.idaDirectorySelect === selectedId;
        control.setAttribute("aria-pressed", isActive ? "true" : "false");
        control.classList.toggle("is-active", isActive);

        const card = control.closest("[data-ida-directory-card]");

        if (card) {
          card.classList.toggle("is-active", isActive);
        }
      });
      syncMapState(selectedId);
    }

    function syncMapState(selectedId) {
      if (!directoryMapReady || !directoryVectorMap) {
        return;
      }

      const member = selectedId ? membersById.get(selectedId) : null;
      const selectedRegions = member && member.regionCode ? [member.regionCode.toUpperCase()] : [];
      const markerIndex = member ? markerIndexesById.get(member.id) : undefined;
      const selectedMarkers = Number.isInteger(markerIndex) ? [markerIndex] : [];

      if (typeof directoryVectorMap.setSelectedRegions === "function") {
        directoryVectorMap.setSelectedRegions(selectedRegions);
      } else if (!selectedRegions.length && typeof directoryVectorMap.clearSelectedRegions === "function") {
        directoryVectorMap.clearSelectedRegions();
      }

      if (typeof directoryVectorMap.setSelectedMarkers === "function") {
        directoryVectorMap.setSelectedMarkers(selectedMarkers);
      } else if (!selectedMarkers.length && typeof directoryVectorMap.clearSelectedMarkers === "function") {
        directoryVectorMap.clearSelectedMarkers();
      }

      if (typeof directoryVectorMap.updateSize === "function") {
        directoryVectorMap.updateSize();
      }
    }

    function syncPanelState(hasSelection) {
      if (emptyState) {
        emptyState.hidden = hasSelection;
      }

      if (contentState) {
        contentState.hidden = !hasSelection;
      }

      if (panel) {
        panel.classList.toggle("is-selected", hasSelection);
      }
    }

    function clearActiveMember() {
      activeMemberId = "";
      syncActiveState("");
      syncPanelState(false);

      if (detailImage) {
        detailImage.removeAttribute("src");
        detailImage.alt = "";
      }

      if (detailName) {
        detailName.textContent = "";
        detailName.removeAttribute("href");
        detailName.setAttribute("aria-disabled", "true");
      }

      if (detailTier) {
        detailTier.textContent = "";
      }

      if (detailAddress) {
        detailAddress.textContent = "";
      }

      if (detailDescription) {
        detailDescription.textContent = "";
        detailDescription.hidden = false;
      }

      if (detailMeta) {
        detailMeta.hidden = false;
      }

      if (detailContact) {
        detailContact.hidden = false;
      }

      clearLink(detailPhone);
      clearLink(detailEmail);
      clearLink(detailWebsite);

      if (detailSocialLinks) {
        detailSocialLinks.innerHTML = "";
      }

      if (detailPhoneRow) {
        detailPhoneRow.hidden = true;
      }

      if (detailEmailRow) {
        detailEmailRow.hidden = true;
      }

      if (detailWebsiteRow) {
        detailWebsiteRow.hidden = true;
      }

      if (detailSocialRow) {
        detailSocialRow.hidden = true;
      }
    }

    function setActiveMember(memberId) {
      const member = DIRECTORY_MEMBERS.find((item) => item.id === memberId);

      if (!member) {
        clearActiveMember();
        return;
      }

      activeMemberId = member.id;
      syncActiveState(member.id);
      syncPanelState(true);

      const isAssociate = isAssociateDirectoryMember(member);
      const publicSocialLinks = getDirectoryPublicSocialLinks(member);
      const hasContactDetails = Boolean(member.phone || member.email || member.website || publicSocialLinks.length);

      if (detailImage) {
        detailImage.src = member.image;
        detailImage.alt = member.name;
      }

      if (detailName) {
        detailName.textContent = member.name;
        if (!isAssociate && member.websiteUrl) {
          detailName.href = member.websiteUrl;
          detailName.removeAttribute("aria-disabled");
        } else {
          detailName.removeAttribute("href");
          detailName.setAttribute("aria-disabled", "true");
        }
      }

      if (detailTier) {
        detailTier.textContent = member.detailTier || member.tier;
      }

      if (detailMeta) {
        detailMeta.hidden = !(member.detailTier || member.tier);
      }

      if (detailAddress) {
        detailAddress.textContent = isAssociate
          ? (member.location || member.address || "")
          : (member.address || member.location || "");
      }

      if (detailDescription) {
        detailDescription.textContent = isAssociate ? "" : (member.description || "");
        detailDescription.hidden = isAssociate || !member.description;
      }

      if (detailPhone) {
        setLink(detailPhone, member.phone || "", member.phone ? `tel:${member.phone}` : "");
      }

      if (detailEmail) {
        setLink(detailEmail, member.email || "", member.email ? `mailto:${member.email}` : "");
      }

      if (detailWebsite) {
        setLink(detailWebsite, member.website || "", member.websiteUrl || "");
      }

      if (detailSocialLinks) {
        detailSocialLinks.innerHTML = buildDirectorySocialLinksMarkup(member);
      }

      if (detailContact) {
        detailContact.hidden = isAssociate || !hasContactDetails;
      }

      if (detailPhoneRow) {
        detailPhoneRow.hidden = isAssociate || !member.phone;
      }

      if (detailEmailRow) {
        detailEmailRow.hidden = isAssociate || !member.email;
      }

      if (detailWebsiteRow) {
        detailWebsiteRow.hidden = isAssociate || !member.website;
      }

      if (detailSocialRow) {
        detailSocialRow.hidden = isAssociate || !publicSocialLinks.length;
      }
    }

    function toggleMember(memberId) {
      if (!memberId) {
        return;
      }

      if (memberId === activeMemberId) {
        clearActiveMember();
        return;
      }

      setActiveMember(memberId);
    }

    function handleMapResize() {
      if (directoryVectorMap && typeof directoryVectorMap.updateSize === "function") {
        directoryVectorMap.updateSize();
      }
    }

    controls.forEach((control) => {
      control.addEventListener("click", () => {
        toggleMember(control.dataset.idaDirectorySelect || "");
      });
    });

    if (jumpButton && mapSection) {
      jumpButton.addEventListener("click", () => {
        mapSection.scrollIntoView({ behavior: "smooth", block: "start" });
      });
    }

    clearActiveMember();

    if (mapMount) {
      ensureJsVectorMapAssets()
        .then((JsVectorMap) => {
          if (destroyed || !mapMount.isConnected || typeof JsVectorMap !== "function") {
            return;
          }

          directoryVectorMap = new JsVectorMap({
            selector: "#ida-directory-vector-map",
            map: "world",
            backgroundColor: "transparent",
            draggable: false,
            zoomButtons: false,
            zoomOnScroll: false,
            zoomMin: 1,
            zoomMax: 1,
            regionStyle: {
              initial: {
                fill: "#dce2e9",
                stroke: "#ffffff",
                strokeWidth: 1.4,
                fillOpacity: 1,
              },
              hover: {
                fill: "#9cb8d4",
                fillOpacity: 1,
              },
              selected: {
                fill: "#6f95bb",
                fillOpacity: 1,
              },
              selectedHover: {
                fill: "#6f95bb",
                fillOpacity: 1,
              },
            },
            markerStyle: {
              initial: {
                fill: "#234f7f",
                stroke: "#ffffff",
                strokeWidth: 4,
                r: 8,
              },
              hover: {
                fill: "#ff5528",
                stroke: "#ffffff",
                strokeWidth: 4,
                r: 8,
              },
              selected: {
                fill: "#ff5528",
                stroke: "#ffffff",
                strokeWidth: 4,
                r: 8.8,
              },
              selectedHover: {
                fill: "#ff5528",
                stroke: "#ffffff",
                strokeWidth: 4,
              },
            },
            labels: {
              markers: {
                render: () => "",
              },
            },
            markersSelectable: true,
            markersSelectableOne: true,
            regionsSelectable: true,
            regionsSelectableOne: true,
            selectedRegions: [],
            selectedMarkers: [],
            markers: mappableMembers.map((member) => ({
              name: member.name,
              coords: [member.lat, member.lng],
              style: getDirectoryMarkerStyle(member),
            })),
            onRegionClick(event, code) {
              const memberIds = getMemberIdsForRegion(code);

              if (!memberIds.length) {
                event.preventDefault();
                return;
              }

              event.preventDefault();

              if (memberIds.length === 1) {
                toggleMember(memberIds[0]);
                return;
              }

              const memberId = getNextMemberIdForRegion(code);

              if (memberId) {
                setActiveMember(memberId);
              }
            },
            onMarkerClick(event, markerIndex) {
              const member = mappableMembers[markerIndex];

              if (!member) {
                event.preventDefault();
                return;
              }

              toggleMember(member.id);
            },
            onRegionTooltipShow(_event, tooltip, code) {
              const memberNames = getMemberIdsForRegion(code)
                .map((memberId) => membersById.get(memberId)?.name)
                .filter(Boolean);

              if (memberNames.length) {
                tooltip.text(memberNames.join(" | "));
              }
            },
            onMarkerTooltipShow(_event, tooltip, markerIndex) {
              const member = mappableMembers[markerIndex];

              if (member) {
                tooltip.text(member.name);
              }
            },
            onLoaded(map) {
              directoryMapReady = true;
              map.updateSize();
              syncMapState(activeMemberId);
              window.setTimeout(() => {
                if (!destroyed && directoryVectorMap === map) {
                  map.updateSize();
                }
              }, 60);
            },
          });

          window.addEventListener("resize", handleMapResize);
        })
        .catch(() => {
          directoryMapReady = false;
        });
    }

    destroyDirectoryMap = () => {
      destroyed = true;
      window.removeEventListener("resize", handleMapResize);

      if (directoryVectorMap && typeof directoryVectorMap.destroy === "function") {
        directoryVectorMap.destroy();
        directoryVectorMap = null;
      }

      directoryMapReady = false;
      destroyDirectoryMap = null;
    };
  }

  function hideDirectoryOriginalContent() {
    hideRouteOriginalContent("[data-ida-directory-page]", DIRECTORY_HIDE_SELECTORS);
  }

  function revealDirectoryOriginalContent() {
    revealRouteOriginalContent();
  }

  function positionDirectoryPage() {
    const injected = document.querySelector("[data-ida-directory-page]");

    if (!injected) {
      return;
    }

    const header = document.querySelector(".ch-header-area, header");
    const root = document.querySelector("#root");
    const footer = document.querySelector(".ch-footer-section, footer");

    if (header && injected.previousElementSibling !== header) {
      header.insertAdjacentElement("afterend", injected);
      return;
    }

    if (!header && footer && injected.nextElementSibling !== footer) {
      footer.insertAdjacentElement("beforebegin", injected);
      return;
    }

    if (!header && !footer && root && injected.parentElement !== root) {
      root.appendChild(injected);
    }
  }

  function injectDirectoryPage() {
    const existing = document.querySelector("[data-ida-directory-page]");

    if (existing) {
      positionDirectoryPage();
      syncInjectedFooterLogo();
      syncInjectedFooterLinks();
      initRoutePageEffects(existing);
      initDirectoryMap();
      return;
    }

    const footer = document.querySelector(".ch-footer-section, footer");
    const header = document.querySelector(".ch-header-area, header");
    const root = document.querySelector("#root");

    if (footer) {
      footer.insertAdjacentHTML("beforebegin", directoryMarkup());
    } else if (header) {
      header.insertAdjacentHTML("afterend", directoryMarkup());
    } else if (root) {
      root.insertAdjacentHTML("beforeend", directoryMarkup());
    }

    positionDirectoryPage();
    syncInjectedFooterLogo();
    syncInjectedFooterLinks();
    initRoutePageEffects("[data-ida-directory-page]");
    initDirectoryMap();
  }

  function cleanupDirectory() {
    if (destroyDirectoryMap) {
      destroyDirectoryMap();
      destroyDirectoryMap = null;
    }

    restoreHeader();
    document.body.classList.remove("ida-directory-page-active");
    revealDirectoryOriginalContent();

    const injected = document.querySelector("[data-ida-directory-page]");

    if (injected) {
      cleanupRoutePageEffects(injected);
      injected.remove();
    }
  }

  function applyDirectory() {
    applyHeader();
    document.body.classList.add("ida-directory-page-active");
    hideDirectoryOriginalContent();
    injectDirectoryPage();
  }

  function cleanupMembership() {
    if (destroyMembershipKeywordBurst) {
      destroyMembershipKeywordBurst();
      destroyMembershipKeywordBurst = null;
    }

    if (destroyBenefitsCarousel) {
      destroyBenefitsCarousel();
      destroyBenefitsCarousel = null;
    }

    restoreHeader();
    document.body.classList.remove("ida-membership-page-active");
    revealMembershipOriginalContent();

    const injected = document.querySelector("[data-ida-membership-page]");

    if (injected) {
      cleanupRoutePageEffects(injected);
      injected.remove();
    }
  }

  function applyMembership() {
    applyHeader();
    document.body.classList.add("ida-membership-page-active");
    hideMembershipOriginalContent();
    injectMembershipPage();
  }

  function positionHomepageSections() {
    const injected = document.querySelector("[data-ida-homepage-sections]");

    if (!injected) {
      return;
    }

    const header = document.querySelector(".ch-header-area, header");
    const root = document.querySelector("#root");
    const footer = document.querySelector(".ch-footer-section, footer");

    if (header && injected.previousElementSibling !== header) {
      header.insertAdjacentElement("afterend", injected);
      return;
    }

    if (!header && footer && injected.nextElementSibling !== footer) {
      footer.insertAdjacentElement("beforebegin", injected);
      return;
    }

    if (!header && !footer && root && injected.parentElement !== root) {
      root.appendChild(injected);
    }
  }

  function injectSections() {
    const existing = document.querySelector("[data-ida-homepage-sections]");

    if (existing) {
      positionHomepageSections();
      syncInjectedFooterLogo();
      syncInjectedFooterLinks();
      initRoutePageEffects(existing);
      initHero();
      initImpactCounters();
      initAudienceSlider();
      initOfferLotties();
      return;
    }

    const footer = document.querySelector(".ch-footer-section, footer");
    const header = document.querySelector(".ch-header-area, header");
    const root = document.querySelector("#root");

    if (footer) {
      footer.insertAdjacentHTML("beforebegin", homepageMarkup());
    } else if (header) {
      header.insertAdjacentHTML("afterend", homepageMarkup());
    } else if (root) {
      root.insertAdjacentHTML("beforeend", homepageMarkup());
    } else {
      return;
    }

    positionHomepageSections();
    syncInjectedFooterLogo();
    syncInjectedFooterLinks();
    initRoutePageEffects("[data-ida-homepage-sections]");
    initHero();
    initImpactCounters();
    initAudienceSlider();
    initOfferLotties();
  }

  function cleanupHomepage() {
    if (destroyHero) {
      destroyHero();
      destroyHero = null;
    }

    if (destroyAudienceSlider) {
      destroyAudienceSlider();
      destroyAudienceSlider = null;
    }

    restoreHeader();
    revealOriginalSections();

    const injected = document.querySelector("[data-ida-homepage-sections]");

    if (injected) {
      cleanupRoutePageEffects(injected);
      injected.remove();
    }
  }

  function applyHomepage() {
    applyHeader();
    hideOriginalSections();
    injectSections();
  }

  function membershipViewReady() {
    return Boolean(document.querySelector("[data-ida-membership-page]"));
  }

  function globalNetworkApplicationViewReady() {
    return Boolean(document.querySelector("[data-ida-global-network-application-page]"));
  }

  function directoryViewReady() {
    return Boolean(document.querySelector("[data-ida-directory-page]"));
  }

  function eventsViewReady() {
    return Boolean(document.querySelector("[data-ida-events-page]"));
  }

  function collaborativeProjectsViewReady() {
    return Boolean(document.querySelector("[data-ida-collaborative-projects-page]"));
  }

  function projectIdeaSubmissionViewReady() {
    return Boolean(document.querySelector("[data-ida-project-idea-page]"));
  }

  function newsSpotlightViewReady() {
    return Boolean(document.querySelector("[data-ida-news-spotlight-page]"));
  }

  function contactViewReady() {
    return Boolean(document.querySelector("[data-ida-contact-page]"));
  }

  function loginViewReady() {
    const form = document.querySelector("#root > form");

    return Boolean(
      form
      && form.dataset.idaLoginReady === "true"
      && document.querySelector("[data-ida-login-footer]")
    );
  }

  function homepageViewReady() {
    return Boolean(document.querySelector("[data-ida-homepage-sections]"));
  }

  function headerNeedsSync() {
    const header = document.querySelector(".ch-header-area");

    if (!document.body.classList.contains("ida-homepage-active")) {
      return true;
    }

    if (!header || !header.classList.contains("ida-home-header")) {
      return true;
    }

    return !header.querySelector(".ida-home-signin");
  }

  function routePageNeedsPosition(pageSelector) {
    const injected = document.querySelector(pageSelector);

    if (!injected) {
      return true;
    }

    const header = document.querySelector(".ch-header-area, header");
    const footer = document.querySelector(".ch-footer-section, footer");

    if (header) {
      return injected.previousElementSibling !== header;
    }

    if (!header && footer) {
      return injected.nextElementSibling !== footer;
    }

    return false;
  }

  function routeOriginalContentVisible(pageSelector, selectors) {
    return selectors.some((selector) =>
      Array.from(document.querySelectorAll(selector)).some((element) => {
        if (element.matches(pageSelector) || element.closest(pageSelector)) {
          return false;
        }

        return getComputedStyle(element).display !== "none";
      })
    );
  }

  function homepageOriginalContentVisible() {
    return HIDE_SELECTORS.some((selector) =>
      Array.from(document.querySelectorAll(selector)).some(
        (element) => getComputedStyle(element).display !== "none"
      )
    );
  }

  function syncHomepage() {
    const currentPath = window.location.pathname;
    const homepageActive = isHomepage();
    const membershipActive = isMembershipPath(currentPath);
    const globalNetworkApplicationActive = isGlobalNetworkApplicationPath(currentPath);
    const directoryActive = isDirectoryPath(currentPath);
    const eventsActive = isEventsPath(currentPath);
    const collaborativeProjectsActive = isCollaborativeProjectsPath(currentPath);
    const projectIdeaSubmissionActive = isProjectIdeaSubmissionPath(currentPath);
    const newsSpotlightActive = isNewsSpotlightPath(currentPath);
    const contactActive = isContactPath(currentPath);
    const loginActive = isLoginPath(currentPath);

    ensureSharedNavigation();
    syncHeaderLogoLink();
    syncRouteMeta(
      homepageActive,
      membershipActive,
      globalNetworkApplicationActive,
      directoryActive,
      eventsActive,
      collaborativeProjectsActive,
      projectIdeaSubmissionActive,
      newsSpotlightActive,
      contactActive,
      loginActive
    );

    if (currentPath === lastPathname) {
      if (loginActive) {
        if (!loginViewReady() || headerNeedsSync()) {
          cleanupHomepage();
          cleanupMembership();
          cleanupGlobalNetworkApplication();
          cleanupDirectory();
          cleanupEvents();
          cleanupCollaborativeProjects();
          cleanupProjectIdeaSubmission();
          cleanupNewsSpotlight();
          cleanupContact();
          applyLogin();
        }
      } else if (globalNetworkApplicationActive) {
        if (
          !globalNetworkApplicationViewReady()
          || headerNeedsSync()
          || routePageNeedsPosition("[data-ida-global-network-application-page]")
          || routeOriginalContentVisible("[data-ida-global-network-application-page]", GLOBAL_NETWORK_APPLICATION_HIDE_SELECTORS)
        ) {
          cleanupHomepage();
          cleanupMembership();
          cleanupDirectory();
          cleanupEvents();
          cleanupCollaborativeProjects();
          cleanupProjectIdeaSubmission();
          cleanupNewsSpotlight();
          cleanupContact();
          cleanupLogin();
          applyGlobalNetworkApplication();
        }
      } else if (membershipActive) {
        if (
          !membershipViewReady()
          || headerNeedsSync()
          || routePageNeedsPosition("[data-ida-membership-page]")
          || routeOriginalContentVisible("[data-ida-membership-page]", MEMBERSHIP_HIDE_SELECTORS)
        ) {
          cleanupHomepage();
          cleanupGlobalNetworkApplication();
          cleanupProjectIdeaSubmission();
          cleanupLogin();
          applyMembership();
        }
      } else if (directoryActive) {
        if (
          !directoryViewReady()
          || headerNeedsSync()
          || routePageNeedsPosition("[data-ida-directory-page]")
          || routeOriginalContentVisible("[data-ida-directory-page]", DIRECTORY_HIDE_SELECTORS)
        ) {
          cleanupHomepage();
          cleanupMembership();
          cleanupGlobalNetworkApplication();
          cleanupContact();
          cleanupProjectIdeaSubmission();
          cleanupLogin();
          applyDirectory();
        }
      } else if (eventsActive) {
        if (
          !eventsViewReady()
          || headerNeedsSync()
          || routePageNeedsPosition("[data-ida-events-page]")
          || routeOriginalContentVisible("[data-ida-events-page]", EVENTS_HIDE_SELECTORS)
        ) {
          cleanupHomepage();
          cleanupMembership();
          cleanupGlobalNetworkApplication();
          cleanupDirectory();
          cleanupContact();
          cleanupProjectIdeaSubmission();
          cleanupLogin();
          applyEvents();
        }
      } else if (collaborativeProjectsActive) {
        if (
          !collaborativeProjectsViewReady()
          || headerNeedsSync()
          || routePageNeedsPosition("[data-ida-collaborative-projects-page]")
          || routeOriginalContentVisible("[data-ida-collaborative-projects-page]", COLLABORATIVE_PROJECTS_HIDE_SELECTORS)
        ) {
          cleanupHomepage();
          cleanupMembership();
          cleanupGlobalNetworkApplication();
          cleanupDirectory();
          cleanupEvents();
          cleanupContact();
          cleanupLogin();
          cleanupProjectIdeaSubmission();
          applyCollaborativeProjects();
        }
      } else if (projectIdeaSubmissionActive) {
        if (
          !projectIdeaSubmissionViewReady()
          || headerNeedsSync()
          || routePageNeedsPosition("[data-ida-project-idea-page]")
          || routeOriginalContentVisible("[data-ida-project-idea-page]", PROJECT_IDEA_SUBMISSION_HIDE_SELECTORS)
        ) {
          cleanupHomepage();
          cleanupMembership();
          cleanupGlobalNetworkApplication();
          cleanupDirectory();
          cleanupEvents();
          cleanupCollaborativeProjects();
          cleanupNewsSpotlight();
          cleanupContact();
          cleanupLogin();
          applyProjectIdeaSubmission();
        }
      } else if (newsSpotlightActive) {
        if (
          !newsSpotlightViewReady()
          || headerNeedsSync()
          || routePageNeedsPosition("[data-ida-news-spotlight-page]")
          || routeOriginalContentVisible("[data-ida-news-spotlight-page]", NEWS_SPOTLIGHT_HIDE_SELECTORS)
        ) {
          cleanupHomepage();
          cleanupMembership();
          cleanupGlobalNetworkApplication();
          cleanupDirectory();
          cleanupEvents();
          cleanupCollaborativeProjects();
          cleanupProjectIdeaSubmission();
          cleanupContact();
          cleanupLogin();
          applyNewsSpotlight();
        }
      } else if (contactActive) {
        if (
          !contactViewReady()
          || headerNeedsSync()
          || routePageNeedsPosition("[data-ida-contact-page]")
          || routeOriginalContentVisible("[data-ida-contact-page]", CONTACT_HIDE_SELECTORS)
        ) {
          cleanupHomepage();
          cleanupMembership();
          cleanupGlobalNetworkApplication();
          cleanupDirectory();
          cleanupEvents();
          cleanupCollaborativeProjects();
          cleanupNewsSpotlight();
          cleanupProjectIdeaSubmission();
          cleanupLogin();
          applyContact();
        }
      } else if (homepageActive) {
        if (
          !homepageViewReady()
          || headerNeedsSync()
          || routePageNeedsPosition("[data-ida-homepage-sections]")
          || homepageOriginalContentVisible()
        ) {
          cleanupMembership();
          cleanupGlobalNetworkApplication();
          cleanupDirectory();
          cleanupEvents();
          cleanupCollaborativeProjects();
          cleanupNewsSpotlight();
          cleanupContact();
          cleanupProjectIdeaSubmission();
          cleanupLogin();
          applyHomepage();
        }
      } else {
        if (homepageViewReady()) {
          cleanupHomepage();
        }

        if (membershipViewReady()) {
          cleanupMembership();
        }

        if (globalNetworkApplicationViewReady()) {
          cleanupGlobalNetworkApplication();
        }

        if (directoryViewReady()) {
          cleanupDirectory();
        }

        if (eventsViewReady()) {
          cleanupEvents();
        }

        if (collaborativeProjectsViewReady()) {
          cleanupCollaborativeProjects();
        }

        if (newsSpotlightViewReady()) {
          cleanupNewsSpotlight();
        }

        if (projectIdeaSubmissionViewReady()) {
          cleanupProjectIdeaSubmission();
        }

        if (contactViewReady()) {
          cleanupContact();
        }

        if (loginViewReady()) {
          cleanupLogin();
        }
      }

      return;
    }

    lastPathname = currentPath;

    if (loginActive) {
      cleanupHomepage();
      cleanupMembership();
      cleanupGlobalNetworkApplication();
      cleanupDirectory();
      cleanupEvents();
      cleanupCollaborativeProjects();
      cleanupProjectIdeaSubmission();
      cleanupNewsSpotlight();
      cleanupContact();
      applyLogin();
    } else if (globalNetworkApplicationActive) {
      cleanupHomepage();
      cleanupMembership();
      cleanupDirectory();
      cleanupEvents();
      cleanupCollaborativeProjects();
      cleanupProjectIdeaSubmission();
      cleanupNewsSpotlight();
      cleanupContact();
      cleanupLogin();
      applyGlobalNetworkApplication();
    } else if (membershipActive) {
      cleanupHomepage();
      cleanupGlobalNetworkApplication();
      cleanupDirectory();
      cleanupEvents();
      cleanupCollaborativeProjects();
      cleanupProjectIdeaSubmission();
      cleanupNewsSpotlight();
      cleanupContact();
      cleanupLogin();
      applyMembership();
    } else if (directoryActive) {
      cleanupHomepage();
      cleanupMembership();
      cleanupGlobalNetworkApplication();
      cleanupEvents();
      cleanupCollaborativeProjects();
      cleanupProjectIdeaSubmission();
      cleanupNewsSpotlight();
      cleanupContact();
      cleanupLogin();
      applyDirectory();
    } else if (eventsActive) {
      cleanupHomepage();
      cleanupMembership();
      cleanupGlobalNetworkApplication();
      cleanupDirectory();
      cleanupCollaborativeProjects();
      cleanupProjectIdeaSubmission();
      cleanupNewsSpotlight();
      cleanupContact();
      cleanupLogin();
      applyEvents();
    } else if (collaborativeProjectsActive) {
      cleanupHomepage();
      cleanupMembership();
      cleanupGlobalNetworkApplication();
      cleanupDirectory();
      cleanupEvents();
      cleanupProjectIdeaSubmission();
      cleanupNewsSpotlight();
      cleanupContact();
      cleanupLogin();
      applyCollaborativeProjects();
    } else if (projectIdeaSubmissionActive) {
      cleanupHomepage();
      cleanupMembership();
      cleanupGlobalNetworkApplication();
      cleanupDirectory();
      cleanupEvents();
      cleanupCollaborativeProjects();
      cleanupNewsSpotlight();
      cleanupContact();
      cleanupLogin();
      applyProjectIdeaSubmission();
    } else if (newsSpotlightActive) {
      cleanupHomepage();
      cleanupMembership();
      cleanupGlobalNetworkApplication();
      cleanupDirectory();
      cleanupEvents();
      cleanupCollaborativeProjects();
      cleanupProjectIdeaSubmission();
      cleanupContact();
      cleanupLogin();
      applyNewsSpotlight();
    } else if (contactActive) {
      cleanupHomepage();
      cleanupMembership();
      cleanupGlobalNetworkApplication();
      cleanupDirectory();
      cleanupEvents();
      cleanupCollaborativeProjects();
      cleanupNewsSpotlight();
      cleanupProjectIdeaSubmission();
      cleanupLogin();
      applyContact();
    } else if (homepageActive) {
      cleanupMembership();
      cleanupGlobalNetworkApplication();
      cleanupDirectory();
      cleanupEvents();
      cleanupCollaborativeProjects();
      cleanupNewsSpotlight();
      cleanupContact();
      cleanupProjectIdeaSubmission();
      cleanupLogin();
      applyHomepage();
    } else {
      cleanupHomepage();
      cleanupMembership();
      cleanupGlobalNetworkApplication();
      cleanupDirectory();
      cleanupEvents();
      cleanupCollaborativeProjects();
      cleanupNewsSpotlight();
      cleanupProjectIdeaSubmission();
      cleanupContact();
      cleanupLogin();
    }
  }

  function queueSync() {
    if (syncQueued) {
      return;
    }

    syncQueued = true;

    window.requestAnimationFrame(() => {
      syncQueued = false;
      syncHomepage();
    });
  }

  const originalPushState = history.pushState;
  const originalReplaceState = history.replaceState;

  history.pushState = function pushState(...args) {
    const result = originalPushState.apply(this, args);
    queueSync();
    return result;
  };

  history.replaceState = function replaceState(...args) {
    const result = originalReplaceState.apply(this, args);
    queueSync();
    return result;
  };

  window.addEventListener("popstate", queueSync);
  window.addEventListener("load", queueSync);
  document.addEventListener("readystatechange", queueSync);

  const observer = new MutationObserver(() => {
    queueSync();
  });

  observer.observe(document.documentElement, {
    childList: true,
    subtree: true,
  });

  document.addEventListener("click", handleSpaLinkClick);

  queueSync();
})();

