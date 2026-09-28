<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Institutional Accreditation | IDA Global Network Central</title>
  <style>
    :root {
      color-scheme: light;
      --navy: #16345b;
      --navy-deep: #102846;
      --blue: #2367a6;
      --teal: #1f9a9c;
      --gold: #d7a642;
      --ink: #182231;
      --muted: #647286;
      --line: #d8e0ea;
      --soft: #f3f7fa;
      --white: #fff;
      --success: #287a55;
      font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }
    * { box-sizing: border-box; }
    html { scroll-behavior: smooth; }
    body { margin: 0; background: var(--soft); color: var(--ink); }
    a { color: inherit; }
    .shell { min-height: 100vh; display: grid; grid-template-columns: 260px minmax(0,1fr); }
    .sidebar {
      position: sticky; top: 0; height: 100vh; overflow-y: auto;
      display: flex; flex-direction: column; gap: 24px;
      padding: 22px 18px; color: var(--white);
      background: linear-gradient(180deg, var(--navy), var(--navy-deep));
    }
    .brand { display: flex; align-items: center; gap: 12px; }
    .brand-logo { width: 46px; height: 46px; border-radius: 8px; object-fit: contain; background: #fff; padding: 4px; }
    .brand strong { display: block; font-size: 15px; line-height: 1.2; }
    .brand span { display: block; margin-top: 3px; color: #bfd0e2; font-size: 12px; }
    .nav { display: grid; gap: 6px; }
    .nav > a, .nav-label-link {
      display: flex; align-items: center; padding: 10px 11px; border-radius: 6px;
      color: #d9e5f1; font-size: 14px; text-decoration: none;
    }
    .nav > a:hover, .nav-label-link { color: #fff; background: rgba(255,255,255,.14); box-shadow: inset 3px 0 0 var(--gold); }
    .nav-sub { display: grid; gap: 7px; margin: 2px 0 8px 33px; }
    .nav-sub a { padding: 7px 9px; border-radius: 6px; color: #c7d7e8; background: rgba(255,255,255,.06); text-decoration: none; font-size: 12px; line-height: 1.25; }
    .nav-sub a:hover, .nav-sub a.active { color: #fff; background: rgba(255,255,255,.12); }
    .nav-group { margin: 0; }
    .nav-group summary { list-style: none; cursor: pointer; }
    .nav-group summary::-webkit-details-marker { display: none; }
    .nav-group > summary {
      display: flex; align-items: center; gap: 9px; padding: 10px 11px; border-radius: 6px;
      color: #d9e5f1; font-size: 14px;
    }
    .nav-group > summary::after { content: "›"; margin-left: auto; color: #bfd0e2; font-size: 12px; transition: transform 160ms ease; }
    .nav-group[open] > summary::after { transform: rotate(90deg); color: var(--gold); }
    .nav-group > summary:hover, .nav-group[open] > summary { color: #fff; background: rgba(255,255,255,.14); box-shadow: inset 3px 0 0 var(--gold); }
    .nav-group .nav-group { margin: 4px 0 3px 18px; }
    .nav-group .nav-group > summary { padding: 7px 9px; color: #c7d7e8; background: rgba(255,255,255,.05); font-size: 12px; box-shadow: none; }
    .nav-group .nav-group[open] > summary, .nav-group .nav-group > summary:hover { color: #fff; background: rgba(255,255,255,.11); box-shadow: none; }
    .nav-group .nav-sub { margin: 5px 0 8px 18px; }
    .nav-group > summary { border: 1px solid rgba(255,255,255,.10); backdrop-filter: blur(12px); box-shadow: 0 7px 17px rgba(3,15,30,.16), inset 0 1px 0 rgba(255,255,255,.08); transition: transform 140ms ease, background 180ms ease, box-shadow 180ms ease; }
    .nav-group.resources-group > summary { background: linear-gradient(135deg, rgba(35,103,166,.31), rgba(215,166,66,.09)); }
    .nav-group.membership-group > summary { border-color: rgba(215,166,66,.25); background: linear-gradient(135deg, rgba(215,166,66,.20), rgba(35,103,166,.16)); }
    .nav-group.accreditation-group > summary { border-color: rgba(31,154,156,.30); background: linear-gradient(135deg, rgba(31,154,156,.29), rgba(35,103,166,.14)); }
    .nav-group.resources-group[open] > summary { background: linear-gradient(135deg, rgba(35,103,166,.52), rgba(215,166,66,.16)); box-shadow: inset 3px 0 0 var(--gold), 0 9px 21px rgba(3,15,30,.22); }
    .nav-group.accreditation-group[open] > summary { background: linear-gradient(135deg, rgba(31,154,156,.52), rgba(35,103,166,.26)); box-shadow: inset 3px 0 0 var(--gold), 0 9px 21px rgba(3,15,30,.22); }
    .nav-group > summary:active { transform: translateY(2px) scale(.985); box-shadow: inset 0 3px 8px rgba(0,0,0,.24); }
    .sidebar-note { margin-top: auto; padding: 14px; border: 1px solid rgba(255,255,255,.18); border-radius: 8px; background: rgba(255,255,255,.10); color: #d7e2ee; font-size: 12px; line-height: 1.5; }
    .main { min-width: 0; }
    .topbar { min-height: 72px; display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 13px 28px; background: #fff; border-bottom: 1px solid var(--line); }
    .topbar h1 { margin: 0; font-size: 21px; line-height: 1.25; }
    .topbar p { margin: 3px 0 0; color: var(--muted); font-size: 13px; }
    .profile { display: flex; align-items: center; gap: 10px; color: var(--muted); font-size: 13px; }
    .avatar { width: 36px; height: 36px; display: grid; place-items: center; border-radius: 50%; background: var(--navy); color: #fff; font-size: 12px; font-weight: 800; }
    .content { max-width: 1280px; margin: 0 auto; padding: 28px; }

    .hero {
      position: relative; overflow: hidden; display: grid; grid-template-columns: minmax(0,1.25fr) minmax(260px,.75fr); gap: 34px;
      padding: 42px; border-radius: 20px; color: #fff;
      background: radial-gradient(circle at 82% 5%, rgba(31,154,156,.55), transparent 31%), linear-gradient(125deg, #102846 0%, #163f69 70%, #2367a6 100%);
      box-shadow: 0 20px 50px rgba(22,52,91,.20);
    }
    .hero::after { content: ""; position: absolute; width: 260px; height: 260px; right: -120px; bottom: -140px; border: 42px solid rgba(255,255,255,.06); border-radius: 50%; }
    .eyebrow { margin: 0 0 11px; color: #f6d98d; font-size: 12px; font-weight: 850; letter-spacing: .12em; text-transform: uppercase; }
    .hero h2 { max-width: 720px; margin: 0; font-size: clamp(31px,4vw,50px); line-height: 1.04; }
    .hero-copy > p:last-of-type { max-width: 700px; margin: 18px 0 25px; color: #dce9f5; font-size: 16px; line-height: 1.65; }
    .hero-actions { display: flex; flex-wrap: wrap; gap: 11px; }
    .button { display: inline-flex; align-items: center; justify-content: center; min-height: 43px; padding: 0 17px; border-radius: 8px; font-size: 13px; font-weight: 800; text-decoration: none; }
    .button.primary { background: var(--gold); color: #142d4d; }
    .button.secondary { border: 1px solid rgba(255,255,255,.35); color: #fff; background: rgba(255,255,255,.08); }
    .eligibility-card { align-self: center; position: relative; z-index: 1; padding: 24px; border: 1px solid rgba(255,255,255,.2); border-radius: 15px; background: rgba(255,255,255,.10); backdrop-filter: blur(8px); }
    .eligibility-card .icon { width: 42px; height: 42px; display: grid; place-items: center; margin-bottom: 15px; border-radius: 12px; background: rgba(215,166,66,.18); color: #f6d98d; font-size: 20px; font-weight: 900; }
    .eligibility-card span { display: block; color: #bcd0e2; font-size: 11px; font-weight: 800; letter-spacing: .08em; text-transform: uppercase; }
    .eligibility-card strong { display: block; margin-top: 8px; font-size: 19px; line-height: 1.35; }
    .eligibility-card p { margin: 10px 0 0; color: #dce9f5; font-size: 13px; line-height: 1.5; }

    .section-head { margin: 42px 0 18px; }
    .section-head h2 { margin: 0; color: var(--navy); font-size: 26px; }
    .section-head p { margin: 7px 0 0; max-width: 770px; color: var(--muted); line-height: 1.6; }
    .readiness { display: grid; grid-template-columns: repeat(2,minmax(0,1fr)); gap: 14px; }
    .check-card { position: relative; min-height: 118px; padding: 21px 21px 20px 58px; border: 1px solid var(--line); border-radius: 13px; background: #fff; box-shadow: 0 7px 22px rgba(22,52,91,.05); }
    .check-card::before { content: "✓"; position: absolute; left: 20px; top: 22px; width: 25px; height: 25px; display: grid; place-items: center; border-radius: 50%; background: #e7f5ed; color: var(--success); font-weight: 900; }
    .check-card h3 { margin: 0 0 6px; color: var(--navy); font-size: 15px; }
    .check-card p { margin: 0; color: var(--muted); font-size: 13px; line-height: 1.5; }
    .check-card { cursor: pointer; transition: transform 160ms ease, border-color 160ms ease, box-shadow 160ms ease; }
    .check-card:hover { transform: translateY(-2px); border-color: #9dbbd5; box-shadow: 0 10px 25px rgba(22,52,91,.09); }
    .check-card input { position: absolute; opacity: 0; pointer-events: none; }
    .check-card:has(input:checked) { border-color: #72b792; background: #f5fbf8; }
    .check-card:has(input:checked)::before { color: #fff; background: var(--success); }
    .score-panel { display: grid; grid-template-columns: auto 1fr; align-items: center; gap: 18px; margin-top: 16px; padding: 20px; border: 1px solid #c9d9e8; border-radius: 13px; background: #fff; }
    .score-number { width: 74px; height: 74px; display: grid; place-items: center; border-radius: 50%; color: #fff; background: var(--navy); font-size: 24px; font-weight: 900; }
    .score-copy strong { display: block; color: var(--navy); font-size: 17px; }
    .score-copy p { margin: 5px 0 0; color: var(--muted); font-size: 13px; line-height: 1.5; }

    .investment { display: grid; grid-template-columns: 1fr 1fr; gap: 17px; }
    .cost-card { position: relative; overflow: hidden; padding: 25px; border-radius: 14px; color: #fff; background: linear-gradient(125deg, var(--navy), var(--blue)); box-shadow: 0 11px 28px rgba(22,52,91,.14); }
    .cost-card.site { background: linear-gradient(125deg, #176d70, var(--teal)); }
    .cost-card span { color: #c8d9e9; font-size: 12px; font-weight: 750; text-transform: uppercase; letter-spacing: .07em; }
    .cost-card strong { display: block; margin: 8px 0 7px; font-size: 34px; }
    .cost-card p { max-width: 440px; margin: 0; color: #e0ecf5; font-size: 13px; line-height: 1.55; }

    .journey { position: relative; display: grid; grid-template-columns: repeat(4,minmax(0,1fr)); gap: 14px; }
    .step { position: relative; padding: 22px; border: 1px solid var(--line); border-top: 4px solid var(--blue); border-radius: 12px; background: #fff; }
    .step:nth-child(2) { border-top-color: var(--teal); }
    .step:nth-child(3) { border-top-color: var(--gold); }
    .step:nth-child(4) { border-top-color: var(--success); }
    .step-number { display: block; margin-bottom: 15px; color: var(--muted); font-size: 11px; font-weight: 850; letter-spacing: .08em; text-transform: uppercase; }
    .step h3 { margin: 0 0 8px; color: var(--navy); font-size: 17px; }
    .step p { margin: 0; color: var(--muted); font-size: 13px; line-height: 1.55; }

    .after-apply { display: grid; grid-template-columns: minmax(220px,.7fr) minmax(0,1.3fr); overflow: hidden; border: 1px solid var(--line); border-radius: 16px; background: #fff; box-shadow: 0 10px 30px rgba(22,52,91,.06); }
    .mentor-panel { padding: 28px; color: #fff; background: linear-gradient(150deg, #16345b, #205f89); }
    .mentor-mark { width: 45px; height: 45px; display: grid; place-items: center; border-radius: 13px; background: rgba(255,255,255,.12); color: #f6d98d; font-size: 22px; font-weight: 900; }
    .mentor-panel h3 { margin: 18px 0 8px; font-size: 23px; }
    .mentor-panel p { margin: 0; color: #dbe8f3; font-size: 13px; line-height: 1.6; }
    .deliverables { padding: 28px; }
    .deliverables h3 { margin: 0 0 17px; color: var(--navy); font-size: 19px; }
    .deliverables ul { display: grid; gap: 12px; margin: 0; padding: 0; list-style: none; }
    .deliverables li { position: relative; padding: 0 0 0 28px; line-height: 1.55; }
    .deliverables li::before { content: "→"; position: absolute; left: 0; color: var(--teal); font-weight: 900; }

    .decision { margin-top: 20px; padding: 24px; border: 1px solid #c9d9e8; border-radius: 14px; background: linear-gradient(90deg,#edf5fb,#f8fbfd); }
    .decision h3 { margin: 0 0 8px; color: var(--navy); font-size: 18px; }
    .decision p { margin: 0; color: var(--muted); line-height: 1.6; }
    .standards { display: grid; grid-template-columns: repeat(4,minmax(0,1fr)); gap: 13px; }
    .standard { padding: 20px; border: 1px solid var(--line); border-radius: 12px; background: #fff; }
    .standard span { display: block; margin-bottom: 12px; color: var(--teal); font-size: 12px; font-weight: 900; }
    .standard h3 { margin: 0 0 7px; color: var(--navy); font-size: 15px; }
    .standard p { margin: 0; color: var(--muted); font-size: 12px; line-height: 1.5; }
    .levels { display: grid; grid-template-columns: repeat(4,minmax(0,1fr)); overflow: hidden; border: 1px solid var(--line); border-radius: 14px; background: #fff; }
    .level { padding: 22px; border-right: 1px solid var(--line); }
    .level:last-child { border-right: 0; }
    .level span { color: var(--gold); font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: .08em; }
    .level h3 { margin: 8px 0; color: var(--navy); font-size: 16px; }
    .level p { margin: 0; color: var(--muted); font-size: 12px; line-height: 1.5; }
    .resource-grid { display: grid; grid-template-columns: repeat(3,minmax(0,1fr)); gap: 14px; }
    .resource-card { display: flex; flex-direction: column; min-height: 180px; padding: 21px; border: 1px solid var(--line); border-radius: 13px; background: #fff; text-decoration: none; transition: transform 160ms ease, box-shadow 160ms ease; }
    .resource-card:hover { transform: translateY(-3px); box-shadow: 0 12px 28px rgba(22,52,91,.10); }
    .file-type { width: fit-content; padding: 5px 8px; border-radius: 5px; color: var(--blue); background: #eaf2fb; font-size: 10px; font-weight: 900; letter-spacing: .07em; }
    .resource-card h3 { margin: 14px 0 7px; color: var(--navy); font-size: 16px; }
    .resource-card p { margin: 0; color: var(--muted); font-size: 12px; line-height: 1.5; }
    .resource-card strong { margin-top: auto; padding-top: 15px; color: var(--blue); font-size: 12px; }
    .contact-strip { margin-top: 17px; display: flex; align-items: center; justify-content: space-between; gap: 18px; padding: 23px; border-radius: 13px; color: #fff; background: linear-gradient(100deg,var(--navy),#205f89); }
    .contact-strip h3 { margin: 0 0 4px; font-size: 18px; }
    .contact-strip p { margin: 0; color: #dbe8f3; font-size: 13px; }
    .source-note { margin: 30px 0 4px; padding: 18px 20px; border-radius: 12px; background: #eaf0f5; color: #536276; font-size: 12px; line-height: 1.55; }
    .source-note a { color: var(--blue); font-weight: 750; }

    @@media (max-width: 1040px) {
      .hero { grid-template-columns: 1fr; }
      .eligibility-card { max-width: 600px; }
      .journey, .standards, .levels { grid-template-columns: 1fr 1fr; }
      .level:nth-child(2) { border-right: 0; }
      .level:nth-child(-n+2) { border-bottom: 1px solid var(--line); }
      .resource-grid { grid-template-columns: 1fr 1fr; }
    }
    @@media (max-width: 860px) {
      .shell { grid-template-columns: 1fr; }
      .sidebar { position: static; height: auto; }
      .nav { grid-template-columns: repeat(3,minmax(0,1fr)); }
      .nav-sub, .sidebar-note { display: none; }
    }
    @@media (max-width: 680px) {
      .sidebar { padding: 16px; gap: 16px; }
      .nav { grid-template-columns: 1fr 1fr; }
      .topbar { padding: 14px 18px; }
      .profile { display: none; }
      .content { padding: 18px; }
      .hero { padding: 29px 23px; }
      .readiness, .investment, .journey, .after-apply, .standards, .levels, .resource-grid { grid-template-columns: 1fr; }
      .level { border-right: 0; border-bottom: 1px solid var(--line); }
      .level:last-child { border-bottom: 0; }
      .score-panel { grid-template-columns: 1fr; }
      .contact-strip { align-items: flex-start; flex-direction: column; }
    }
  </style>
  <link rel="stylesheet" href="{{ asset('assets/dashboard/gn-central/preview-assets') }}/gn-central-navigation.css">
</head>
<body>
  <div class="shell">
    <aside class="sidebar" aria-label="Primary navigation">
      <div class="brand">
        <img class="brand-logo" src="{{ asset('assets/dashboard/gn-central/preview-assets') }}/ida-global-network-logo.png" alt="IDA Global Network logo">
        <div><strong>Global Network Central</strong><span>International Dyslexia Association</span></div>
      </div>
      <nav class="nav">
        <a data-icon="⌂" href="{{ route('dashboard.index') }}">Home</a>
        <a data-icon="▤" href="{{ route('dashboard.membership-applications.index') }}">Applications</a>
        <a data-icon="◎" href="{{ route('dashboard.index') }}#member-panel">Global Network Members</a>
        <a data-icon="♛" data-section="leadership" href="{{ route('dashboard.member-leadership.index') }}">Member Leadership</a>
        <a data-icon="◫" href="{{ route('dashboard.member-operations.index') }}">Member Operations</a>
        <a data-icon="◇" href="#">Events</a>
        <details class="nav-group resources-group" data-section="resources" open>
          <summary data-icon="▥">Resources</summary>
          <details class="nav-group membership-group">
            <summary>Membership Options</summary>
            <div class="nav-sub">
              <a href="{{ route('dashboard.membership-options.index') }}">Overview</a>
              <a href="{{ route('dashboard.membership-options.index') }}#associate">Associate</a>
              <a href="{{ route('dashboard.membership-options.index') }}#contributor">Contributor</a>
              <a href="{{ route('dashboard.membership-options.index') }}#partner">Partner</a>
            </div>
          </details>
        </details>
        <details class="nav-group accreditation-group current-section" data-section="accreditation" open>
          <summary data-icon="✪">Institutional Accreditation</summary>
          <div class="nav-sub" aria-label="Institutional accreditation sections">
            <a class="active" href="#top">Overview</a>
            <a href="#readiness">Applicant readiness</a>
            <a href="#process">Application journey</a>
            <a href="#after-application">After you apply</a>
            <a href="#standards">Quality standards</a>
            <a href="#resources">Application packet</a>
            <a href="{{ route('dashboard.accreditation-application.index') }}">Apply online</a>
            <a href="{{ route('dashboard.accreditation-workspace.index') }}">Process workspace</a>
            <a href="{{ route('dashboard.accreditation-reviewer-training.index') }}">Reviewer training</a>
          </div>
        </details>
        <a data-icon="✉" href="{{ route('dashboard.resource-centre.index') }}">Communications</a><a data-icon="▦" href="#">Reports</a><a data-icon="⚙" href="{{ route('dashboard.authority-levels.index') }}">Authority &amp; Profiles</a>
      </nav>
      <div class="sidebar-note">A guided accreditation resource for eligible IDA Global Network member organizations preparing to apply.</div>
    </aside>

    <main class="main" id="top">
      <header class="topbar">
        <div><h1>Institutional Accreditation</h1><p>Applicant readiness, requirements, and process guidance.</p></div>
        <div class="profile"><div class="avatar">GN</div><span>Central Office</span></div>
      </header>

      <div class="content">
        <section class="hero">
          <div class="hero-copy">
            <p class="eyebrow">IDA Around the World</p>
            <h2>Build confidence in the quality of your institution.</h2>
            <p>Institutional Accreditation supports professional standards of operational integrity and service quality consistent with IDA values and its definition of dyslexia.</p>
            <div class="hero-actions"><a class="button primary" href="{{ route('dashboard.accreditation-application.index') }}">Start online application</a><a class="button secondary" href="#readiness">Check your readiness</a></div>
          </div>
          <aside class="eligibility-card" aria-label="Eligibility requirement">
            <div class="icon">✓</div><span>Eligibility requirement</span>
            <strong>All IDA Global Network member organizations in good standing may apply.</strong>
            <p>Confirm your active Associate, Contributor or Partner membership status with IDA before beginning the Initial Application.</p>
          </aside>
        </section>

        <section id="readiness">
          <div class="section-head"><h2>Are you ready to apply?</h2><p>Select every statement that is true for your institution. This self-check follows the eight-question readiness questionnaire in the current application packet.</p></div>
          <div class="readiness" id="readinessChecklist">
            <label class="check-card"><input type="checkbox"><h3>Global Network status</h3><p>We are an IDA Global Network Organization in good standing.</p></label>
            <label class="check-card"><input type="checkbox"><h3>License to operate</h3><p>We have a non-provisional, government-issued license to operate.</p></label>
            <label class="check-card"><input type="checkbox"><h3>Three-year strategy</h3><p>We have a current three-year Strategic Plan with a clear vision, mission, goals, and objectives.</p></label>
            <label class="check-card"><input type="checkbox"><h3>Financial sustainability</h3><p>We have documented sources of financial support to sustain efficient operations.</p></label>
            <label class="check-card"><input type="checkbox"><h3>Qualified personnel</h3><p>Our personnel have qualifications appropriate for institutional management.</p></label>
            <label class="check-card"><input type="checkbox"><h3>Continuous development</h3><p>We have a plan for regular self-evaluation and ongoing development.</p></label>
            <label class="check-card"><input type="checkbox"><h3>Outcome evidence</h3><p>We have data showing the benefits of our programs and services.</p></label>
            <label class="check-card"><input type="checkbox"><h3>Review evidence</h3><p>We have reports of internal and external reviews of the institution.</p></label>
          </div>
          <div class="score-panel" aria-live="polite"><div class="score-number" id="scoreNumber">0/8</div><div class="score-copy"><strong id="scoreTitle">Complete your readiness check</strong><p id="scoreMessage">Select the statements that currently apply to your institution.</p></div></div>
        </section>

        <section>
          <div class="section-head"><h2>Plan the financial investment</h2><p>The 2024 FAQ and cover letter provide the current staged fee schedule. Initial payment is made in US dollars by credit card.</p></div>
          <div class="investment">
            <article class="cost-card"><span>Initial Application</span><strong>$1,000</strong><p>IDA administrative fee, required when the Initial Application is submitted.</p></article>
            <article class="cost-card site"><span>Project and site-visit honoraria</span><strong>$1,000 + $1,000</strong><p>Mentor honorarium is paid upon signing the Project Agreement; the site-visit work honorarium is billed 60-90 days before the visit. Travel, lodging, meals, and other visit services are arranged separately with the reviewer.</p></article>
          </div>
        </section>

        <section id="standards">
          <div class="section-head"><h2>Eight Institutional Quality Standards</h2><p>The Self-Study Report asks institutions to assemble English-language evidence across these eight areas.</p></div>
          <div class="standards">
            <article class="standard"><span>01</span><h3>Institutional Qualifications</h3><p>Legal status and a permanent, non-provisional license to operate.</p></article>
            <article class="standard"><span>02</span><h3>Mission and Planning</h3><p>Vision, mission, goals, a three-year plan, and measurable performance indicators.</p></article>
            <article class="standard"><span>03</span><h3>Organizational and Financial Resources</h3><p>Policies, audited accounts, sustainable funding, and operating reserves.</p></article>
            <article class="standard"><span>04</span><h3>Personnel Qualifications</h3><p>Clear roles, appropriate credentials, job descriptions, and evaluation practices.</p></article>
            <article class="standard"><span>05</span><h3>Facilities and Infrastructure</h3><p>Safe, suitable, maintained facilities, technology, equipment, and materials.</p></article>
            <article class="standard"><span>06</span><h3>Communication and Engagement</h3><p>Consistent, transparent internal and external communication.</p></article>
            <article class="standard"><span>07</span><h3>Impact and Relationships</h3><p>Strategic alliances, partnerships, and evidence of community impact.</p></article>
            <article class="standard"><span>08</span><h3>Self-Evaluation and Development</h3><p>Outcome data, continuous review, improvement plans, and governance evidence.</p></article>
          </div>
        </section>

        <section>
          <div class="section-head"><h2>Accreditation levels</h2><p>Accreditation is valid for four years. Re-accreditation should begin twelve months before expiration.</p></div>
          <div class="levels">
            <article class="level"><span>Level I</span><h3>Applicant</h3><p>Application accepted; the institution is working toward a visit-team recommendation.</p></article>
            <article class="level"><span>Level II</span><h3>Provisional</h3><p>Core requirements are met, with progress demonstrated across the remaining standards.</p></article>
            <article class="level"><span>Level III</span><h3>Full Accreditation</h3><p>The institution meets the criteria for all Institutional Quality Standards.</p></article>
            <article class="level"><span>Level IV</span><h3>With Commendation</h3><p>A well-established institution has met all standards across three review cycles.</p></article>
          </div>
        </section>

        <section id="resources">
          <div class="section-head"><h2>Current application packet</h2><p>Open or download the core 2024 applicant materials from the Institutional Accreditation folder.</p></div>
          <div class="resource-grid">
            <a class="resource-card" href="{{ asset('assets/dashboard/gn-central/GN Central') }}/Institutional Accreditation/Current Packet/Application Packet/IDA_InstitutionalAccreditationPlan_Version 2.0_2024.pdf"><span class="file-type">PDF · 13 pages</span><h3>Accreditation Plan 2.0</h3><p>Standards, eligibility, accreditation levels, process, and key terminology.</p><strong>Open plan →</strong></a>
            <a class="resource-card" href="{{ asset('assets/dashboard/gn-central/GN Central') }}/Institutional Accreditation/Current Packet/Application Packet/IDA_FAQs_Accreditation 2024.pdf"><span class="file-type">PDF · 2 pages</span><h3>Frequently Asked Questions</h3><p>Benefits, prerequisites, fee schedule, site visits, validity, and renewal.</p><strong>Open FAQs →</strong></a>
            <a class="resource-card" href="{{ asset('assets/dashboard/gn-central/GN Central') }}/Institutional Accreditation/Current Packet/Application Packet/Self-Study Report_Final.pdf"><span class="file-type">PDF · 5 pages</span><h3>Self-Study Report</h3><p>The evidence checklist used by institutions and reviewers across all standards.</p><strong>Open report →</strong></a>
            <a class="resource-card" href="{{ asset('assets/dashboard/gn-central/GN Central') }}/Institutional Accreditation/Current Packet/Application Packet/IDA_Accreditation_Cover Letter_2024.pdf"><span class="file-type">PDF · 2 pages</span><h3>Applicant Cover Letter</h3><p>Readiness questionnaire, preparation steps, fees, and what happens after applying.</p><strong>Open letter →</strong></a>
            <a class="resource-card" href="{{ asset('assets/dashboard/gn-central/GN Central') }}/Institutional Accreditation/Current Packet/Application Packet/IDA_Accreditation_Application_2024.docx"><span class="file-type">DOCX</span><h3>Initial Application</h3><p>The current editable 2024 application form for eligible organizations.</p><strong>Open application →</strong></a>
            <a class="resource-card" href="{{ asset('assets/dashboard/gn-central/GN Central') }}/Institutional Accreditation/Current Packet/Application Packet/IDA_Accreditation_Rating_Matrix (June 2016) w Self-Study Report_Final.xlsx"><span class="file-type">XLSX</span><h3>Rating Matrix</h3><p>The structured review matrix accompanying the Self-Study Report.</p><strong>Open matrix →</strong></a>
          </div>
          <div class="contact-strip"><div><h3>Ready to request application access?</h3><p>Contact Dana Nwoye, Manager, Special Projects, for confirmation and next steps.</p></div><a class="button primary" href="mailto:dnwoye@dyslexiaida.org">Email dnwoye@dyslexiaida.org</a></div>
        </section>

        <section id="process">
          <div class="section-head"><h2>Your accreditation journey</h2><p>The application moves from organizational preparation into a mentor-supported self-study, evidence review, and site visit.</p></div>
          <div class="journey">
            <article class="step"><span class="step-number">Stage 01</span><h3>Prepare</h3><p>Confirm eligibility, review the plan and FAQs, select your primary contact, and secure resources.</p></article>
            <article class="step"><span class="step-number">Stage 02</span><h3>Apply</h3><p>Complete the Initial Application and submit the required application payment.</p></article>
            <article class="step"><span class="step-number">Stage 03</span><h3>Self-study</h3><p>Work with an assigned IDA Mentor, complete the Self-Study Report, and assemble evidence.</p></article>
            <article class="step"><span class="step-number">Stage 04</span><h3>Site visit</h3><p>Secure funding and resources for the IDA Institutional Accreditation site visit.</p></article>
          </div>
        </section>

        <section id="after-application">
          <div class="section-head"><h2>What happens after the Initial Application?</h2><p>IDA provides guided support while your institution builds and organizes the materials required for review.</p></div>
          <div class="after-apply">
            <aside class="mentor-panel"><div class="mentor-mark">M</div><h3>Your IDA Mentor</h3><p>An assigned mentor guides you through the accreditation process and helps identify and assemble the accreditation criteria and electronic documents outlined in the Self-Study Report.</p></aside>
            <div class="deliverables"><h3>Your institution will</h3><ul>
              <li>Complete the Self-Study Report.</li>
              <li>Assemble a Digital Inventory in English containing evidence for each Institutional Accreditation Standard.</li>
              <li>Secure adequate funding and resources for the accreditation site visit.</li>
            </ul></div>
          </div>
          <div class="decision"><h3>Readiness decision</h3><p>Your primary contact will receive written confirmation from IDA based on the recommendations of your IDA Mentor. The confirmation will state whether the organization is ready to move forward with the site-visit portion of the accreditation process and will provide next-step instructions.</p></div>
        </section>

        <p class="source-note"><strong>Source:</strong> Content adapted from the <a href="{{ asset('assets/dashboard/gn-central/GN Central') }}/Institutional Accreditation/Current Packet/Application Packet/IDA_InstitutionalAccreditationPlan_Version 2.0_2024.pdf">Institutional Accreditation Plan Version 2.0 (2024)</a>, 2024 FAQs, applicant cover letter, and Self-Study Report. These current-packet materials supersede the older fee figures shown in the standalone program overview.</p>
      </div>
    </main>
  </div>
  <script>
    const readinessInputs = [...document.querySelectorAll('#readinessChecklist input')];
    const scoreNumber = document.getElementById('scoreNumber');
    const scoreTitle = document.getElementById('scoreTitle');
    const scoreMessage = document.getElementById('scoreMessage');

    function updateReadinessScore() {
      const score = readinessInputs.filter((input) => input.checked).length;
      scoreNumber.textContent = `${score}/8`;
      if (score <= 4) {
        scoreTitle.textContent = score === 0 ? 'Complete your readiness check' : 'Your institution is not ready to apply yet';
        scoreMessage.textContent = score === 0 ? 'Select the statements that currently apply to your institution.' : 'Use the Accreditation Plan to develop the remaining requirements before applying.';
      } else if (score <= 6) {
        scoreTitle.textContent = 'Your institution is almost ready';
        scoreMessage.textContent = 'Focus on the remaining requirements, then repeat this readiness check.';
      } else {
        scoreTitle.textContent = 'Your institution appears ready to apply';
        scoreMessage.textContent = 'Review the current application packet and contact IDA to confirm your status and next steps.';
      }
    }
    readinessInputs.forEach((input) => input.addEventListener('change', updateReadinessScore));
  </script>
</body>
</html>
