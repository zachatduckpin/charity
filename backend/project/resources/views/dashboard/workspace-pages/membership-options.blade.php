<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Membership Options | IDA Global Network Central</title>
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
      font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    * { box-sizing: border-box; }
    html { scroll-behavior: smooth; }
    body { margin: 0; background: var(--soft); color: var(--ink); }
    a { color: inherit; }

    .shell {
      min-height: 100vh;
      display: grid;
      grid-template-columns: 260px minmax(0, 1fr);
    }

    .sidebar {
      position: sticky;
      top: 0;
      height: 100vh;
      overflow-y: auto;
      background: linear-gradient(180deg, var(--navy), var(--navy-deep));
      color: var(--white);
      padding: 22px 18px;
      display: flex;
      flex-direction: column;
      gap: 24px;
    }

    .brand { display: flex; align-items: center; gap: 12px; }
    .brand-logo {
      width: 46px;
      height: 46px;
      border-radius: 8px;
      object-fit: contain;
      background: var(--white);
      padding: 4px;
    }
    .brand strong { display: block; font-size: 15px; line-height: 1.2; }
    .brand span { display: block; color: #bfd0e2; font-size: 12px; margin-top: 3px; }

    .nav { display: grid; gap: 6px; }
    .nav > a,
    .nav-label-link {
      color: #d9e5f1;
      text-decoration: none;
      display: flex;
      align-items: center;
      padding: 10px 11px;
      border-radius: 6px;
      font-size: 14px;
    }
    .nav > a:hover,
    .nav > a.active,
    .nav-label-link {
      color: var(--white);
      background: rgba(255,255,255,.14);
      box-shadow: inset 3px 0 0 var(--gold);
    }
    .nav-sub { display: grid; gap: 7px; margin: 2px 0 8px 33px; }
    .nav-sub a {
      padding: 7px 9px;
      border-radius: 6px;
      color: #c7d7e8;
      background: rgba(255,255,255,.06);
      text-decoration: none;
      font-size: 12px;
      line-height: 1.25;
    }
    .nav-sub a:hover { color: var(--white); background: rgba(255,255,255,.12); }
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
    .nav-group.resources-group[open] > summary { background: linear-gradient(135deg, rgba(35,103,166,.52), rgba(215,166,66,.16)); box-shadow: inset 3px 0 0 var(--gold), 0 9px 21px rgba(3,15,30,.22); }
    .nav-group.membership-group[open] > summary { background: linear-gradient(135deg, rgba(215,166,66,.34), rgba(35,103,166,.30)); box-shadow: inset 3px 0 0 #f2c65e, 0 8px 18px rgba(3,15,30,.19); }
    .nav-group > summary:active { transform: translateY(2px) scale(.985); box-shadow: inset 0 3px 8px rgba(0,0,0,.24); }
    .nav > a.accreditation-main { border: 1px solid rgba(31,154,156,.25); background: linear-gradient(135deg, rgba(31,154,156,.24), rgba(35,103,166,.12)); box-shadow: inset 3px 0 0 var(--gold), 0 7px 16px rgba(3,15,30,.16); }
    .sidebar-note {
      margin-top: auto;
      padding: 14px;
      border: 1px solid rgba(255,255,255,.18);
      border-radius: 8px;
      background: rgba(255,255,255,.10);
      color: #d7e2ee;
      font-size: 12px;
      line-height: 1.5;
    }

    .main { min-width: 0; }
    .topbar {
      min-height: 72px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      padding: 13px 28px;
      background: var(--white);
      border-bottom: 1px solid var(--line);
    }
    .topbar h1 { margin: 0; font-size: 21px; line-height: 1.25; }
    .topbar p { margin: 3px 0 0; color: var(--muted); font-size: 13px; }
    .profile { display: flex; align-items: center; gap: 10px; color: var(--muted); font-size: 13px; }
    .avatar {
      width: 36px;
      height: 36px;
      display: grid;
      place-items: center;
      border-radius: 50%;
      background: var(--navy);
      color: var(--white);
      font-size: 12px;
      font-weight: 800;
    }

    .content { padding: 28px; max-width: 1280px; margin: 0 auto; }
    .hero {
      position: relative;
      overflow: hidden;
      padding: 38px;
      border-radius: 18px;
      color: var(--white);
      background: linear-gradient(120deg, #16345b 0%, #205d8b 62%, #1f9a9c 130%);
      box-shadow: 0 18px 45px rgba(22,52,91,.18);
    }
    .hero::after {
      content: "";
      position: absolute;
      width: 280px;
      height: 280px;
      right: -90px;
      top: -130px;
      border: 44px solid rgba(255,255,255,.08);
      border-radius: 50%;
    }
    .eyebrow {
      margin: 0 0 10px;
      color: #f6d98d;
      font-size: 12px;
      font-weight: 800;
      letter-spacing: .12em;
      text-transform: uppercase;
    }
    .hero h2 { max-width: 730px; margin: 0; font-size: clamp(30px, 4vw, 48px); line-height: 1.05; }
    .hero p:last-child { max-width: 720px; margin: 17px 0 0; color: #e2edf6; font-size: 16px; line-height: 1.65; }

    .section-heading { margin: 42px 0 18px; }
    .section-heading h2 { margin: 0; color: var(--navy); font-size: 25px; }
    .section-heading p { margin: 7px 0 0; color: var(--muted); line-height: 1.6; }

    .tier-grid { display: grid; grid-template-columns: repeat(3, minmax(0,1fr)); gap: 18px; }
    .tier-card {
      position: relative;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      min-height: 285px;
      padding: 24px;
      border: 1px solid var(--line);
      border-top: 5px solid var(--tier);
      border-radius: 14px;
      background: var(--white);
      box-shadow: 0 8px 25px rgba(22,52,91,.07);
    }
    .tier-card::after {
      content: "";
      position: absolute;
      width: 110px;
      height: 110px;
      right: -48px;
      top: -55px;
      border-radius: 50%;
      background: var(--tier);
      opacity: .11;
    }
    .tier-card.associate, .detail.associate { --tier: var(--teal); --tint: #e7f7f5; }
    .tier-card.contributor, .detail.contributor { --tier: var(--blue); --tint: #eaf2fb; }
    .tier-card.partner, .detail.partner { --tier: var(--gold); --tint: #fff5dc; }
    .tier-kicker { color: var(--tier); font-size: 12px; font-weight: 850; letter-spacing: .08em; text-transform: uppercase; }
    .tier-card h3 { margin: 9px 0 9px; color: var(--navy); font-size: 23px; }
    .tier-card p { margin: 0; color: var(--muted); line-height: 1.55; }
    .price { margin: 20px 0 18px; color: var(--navy); font-size: 30px; font-weight: 850; }
    .price span { color: var(--muted); font-size: 12px; font-weight: 600; }
    .card-link {
      margin-top: auto;
      color: var(--tier);
      text-decoration: none;
      font-size: 13px;
      font-weight: 800;
    }

    .comparison {
      margin-top: 18px;
      display: grid;
      grid-template-columns: repeat(3, minmax(0,1fr));
      border: 1px solid var(--line);
      border-radius: 12px;
      overflow: hidden;
      background: var(--white);
    }
    .compare-item { padding: 18px 20px; border-right: 1px solid var(--line); }
    .compare-item:last-child { border-right: 0; }
    .compare-item span { display: block; color: var(--muted); font-size: 12px; }
    .compare-item strong { display: block; margin-top: 5px; color: var(--navy); font-size: 15px; }

    .detail {
      scroll-margin-top: 20px;
      margin-top: 28px;
      border: 1px solid var(--line);
      border-radius: 16px;
      background: var(--white);
      box-shadow: 0 10px 30px rgba(22,52,91,.06);
      overflow: hidden;
    }
    .detail-head {
      display: grid;
      grid-template-columns: 1fr auto;
      align-items: center;
      gap: 20px;
      padding: 24px 27px;
      background: linear-gradient(90deg, var(--tint), #fff);
      border-left: 7px solid var(--tier);
    }
    .detail-head .eyebrow { color: var(--tier); margin-bottom: 5px; }
    .detail-head h2 { margin: 0; color: var(--navy); font-size: 28px; }
    .detail-head p { margin: 7px 0 0; color: var(--muted); line-height: 1.55; }
    .fee {
      min-width: 125px;
      padding: 13px 16px;
      border: 1px solid color-mix(in srgb, var(--tier) 45%, white);
      border-radius: 10px;
      background: var(--white);
      color: var(--navy);
      text-align: center;
      font-size: 21px;
      font-weight: 850;
    }
    .fee span { display: block; margin-top: 2px; color: var(--muted); font-size: 10px; font-weight: 700; text-transform: uppercase; }
    .responsibilities { display: grid; grid-template-columns: 1fr 1fr; }
    .responsibility { padding: 27px; }
    .responsibility + .responsibility { border-left: 1px solid var(--line); background: #fbfcfe; }
    .responsibility h3 { margin: 0 0 16px; color: var(--navy); font-size: 17px; }
    .responsibility h3 span {
      display: inline-grid;
      place-items: center;
      width: 28px;
      height: 28px;
      margin-right: 7px;
      border-radius: 8px;
      background: var(--tint);
      color: var(--tier);
      font-size: 13px;
    }
    ul { margin: 0; padding: 0; list-style: none; }
    li { position: relative; padding: 0 0 12px 23px; line-height: 1.55; }
    li:last-child { padding-bottom: 0; }
    li::before {
      content: "✓";
      position: absolute;
      left: 0;
      top: 1px;
      color: var(--tier);
      font-weight: 900;
    }
    .process {
      display: grid;
      grid-template-columns: repeat(3, minmax(0,1fr));
      gap: 13px;
      padding: 0 27px 27px;
    }
    .process div { padding: 16px; border-radius: 10px; background: var(--tint); }
    .process strong { display: block; margin-bottom: 5px; color: var(--navy); font-size: 13px; }
    .process p { margin: 0; color: var(--muted); font-size: 12px; line-height: 1.45; }

    .source-note {
      margin: 30px 0 4px;
      padding: 18px 20px;
      border-radius: 12px;
      background: #eaf0f5;
      color: #536276;
      font-size: 12px;
      line-height: 1.55;
    }
    .source-note a { color: var(--blue); font-weight: 750; }

    @@media (max-width: 980px) {
      .shell { grid-template-columns: 1fr; }
      .sidebar { position: static; height: auto; }
      .nav { grid-template-columns: repeat(3, minmax(0,1fr)); }
      .nav-sub, .sidebar-note { display: none; }
      .tier-grid { grid-template-columns: 1fr; }
      .tier-card { min-height: 0; }
    }
    @@media (max-width: 720px) {
      .sidebar { padding: 16px; gap: 16px; }
      .nav { grid-template-columns: 1fr 1fr; }
      .topbar { padding: 14px 18px; }
      .profile { display: none; }
      .content { padding: 18px; }
      .hero { padding: 28px 23px; }
      .comparison, .responsibilities, .process { grid-template-columns: 1fr; }
      .compare-item { border-right: 0; border-bottom: 1px solid var(--line); }
      .compare-item:last-child { border-bottom: 0; }
      .responsibility + .responsibility { border-left: 0; border-top: 1px solid var(--line); }
      .detail-head { grid-template-columns: 1fr; }
      .fee { width: fit-content; text-align: left; }
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
        <details class="nav-group resources-group current-section" data-section="resources" open>
          <summary data-icon="▥">Resources</summary>
          <details class="nav-group membership-group" open>
            <summary>Membership Options</summary>
            <div class="nav-sub" aria-label="Membership option sections">
              <a href="#overview">Overview</a>
              <a href="#associate">Associate Connection</a>
              <a href="#contributor">Contributor Connection</a>
              <a href="#partner">Partner Connection</a>
            </div>
          </details>
          <div class="nav-sub"><a href="{{ route('dashboard.handbook.index') }}">GN Handbook</a></div>
          <div class="nav-sub"><a href="{{ route('dashboard.video-library.index') }}">Video &amp; Reels Library</a></div>
        </details>
        <a class="accreditation-main" data-icon="✪" data-section="accreditation" href="{{ route('dashboard.accreditation.index') }}">Institutional Accreditation</a>
        <a data-icon="✉" href="{{ route('dashboard.resource-centre.index') }}">Communications</a>
        <a data-icon="▦" href="#">Reports</a>
        <a data-icon="⚙" href="{{ route('dashboard.authority-levels.index') }}">Authority &amp; Profiles</a>
      </nav>
      <div class="sidebar-note">Explore Global Network connection levels, organizational responsibilities, and the support provided by the IDA Home Office.</div>
    </aside>

    <main class="main">
      <header class="topbar">
        <div><h1>Resources</h1><p>Global Network membership guidance and responsibilities.</p></div>
        <div class="profile"><div class="avatar">GN</div><span>Central Office</span></div>
      </header>

      <div class="content">
        <section class="hero" id="overview">
          <p class="eyebrow">Membership guidance</p>
          <h2>Find the right connection for your organization.</h2>
          <p>IDA Global Network offers three paths for eligible organizations. Compare the annual commitment, understand what each side provides, and explore the requirements for every connection level.</p>
        </section>

        <div class="section-heading"><h2>Three ways to connect</h2><p>Each level offers a distinct pathway into the Global Network, from an introductory connection to full partnership and governance participation.</p></div>
        <section class="tier-grid" aria-label="Membership tier overview">
          <article class="tier-card associate">
            <span class="tier-kicker">Introductory level</span><h3>Associate</h3>
            <p>Designed for new organizations beginning their relationship with the IDA Global Network.</p>
            <div class="price">$100 <span>USD / year</span></div>
            <a class="card-link" href="#associate">Explore Associate responsibilities →</a>
          </article>
          <article class="tier-card contributor">
            <span class="tier-kicker">Engaged level</span><h3>Contributor</h3>
            <p>For established nonprofit organizations ready for broader resources and network participation.</p>
            <div class="price">$350 <span>USD / year</span></div>
            <a class="card-link" href="#contributor">Explore Contributor responsibilities →</a>
          </article>
          <article class="tier-card partner">
            <span class="tier-kicker">Leadership level</span><h3>Partner</h3>
            <p>The most comprehensive connection, with collaboration opportunities and a voting seat.</p>
            <div class="price">$750 <span>USD / year</span></div>
            <a class="card-link" href="#partner">Explore Partner responsibilities →</a>
          </article>
        </section>

        <section class="comparison" aria-label="At-a-glance comparison">
          <div class="compare-item"><span>Associate engagement</span><strong>2 annual Sip and Chat meetings</strong></div>
          <div class="compare-item"><span>Contributor engagement</span><strong>3 annual Sip and Chat meetings</strong></div>
          <div class="compare-item"><span>Partner engagement</span><strong>4 annual Sip and Chat meetings + voting seat</strong></div>
        </section>

        <div class="section-heading"><h2>Responsibilities by connection</h2><p>Review what the organization commits to and what the IDA Home Office provides at each level.</p></div>

        <article class="detail associate" id="associate">
          <header class="detail-head">
            <div><p class="eyebrow">Introductory level</p><h2>Associate Connection</h2><p>For new organizations seeking an initial connection with the Global Network.</p></div>
            <div class="fee">$100<span>Annual renewal fee</span></div>
          </header>
          <div class="responsibilities">
            <section class="responsibility"><h3><span>01</span> Associate responsibilities</h3><ul>
              <li>Exist as a non-governmental, not-for-profit organization.</li>
              <li>Pay an annual renewal fee of $100 USD.</li>
            </ul></section>
            <section class="responsibility"><h3><span>02</span> IDA Home Office provides</h3><ul>
              <li>Invitation to two online “Sip and Chat” meetings annually.</li>
              <li>Subscription to IDA’s “What’s Happening at IDA” newsletter.</li>
            </ul></section>
          </div>
        </article>

        <article class="detail contributor" id="contributor">
          <header class="detail-head">
            <div><p class="eyebrow">Engaged level</p><h2>Contributor Connection</h2><p>A structured connection with application review, shared expectations, and expanded network access.</p></div>
            <div class="fee">$350<span>Annual fee</span></div>
          </header>
          <div class="process" aria-label="Contributor application process">
            <div><strong>1. Apply</strong><p>The agency completes an application.</p></div>
            <div><strong>2. Review</strong><p>The GN Executive Committee reviews and recommends it to the IDA Board.</p></div>
            <div><strong>3. Agree</strong><p>IDA and the agency sign a limited operations and usage agreement.</p></div>
          </div>
          <div class="responsibilities">
            <section class="responsibility"><h3><span>01</span> Contributor responsibilities</h3><ul>
              <li>Stay up to date on IDA’s vision.</li>
              <li>Exist as a non-governmental, not-for-profit organization.</li>
              <li>Meet the Partner requirements before consideration for Partner level.</li>
              <li>Pay an annual fee of $350 USD.</li>
              <li>Comply with documented bylaws and all local regulations.</li>
              <li>Institutional Accreditation is strongly encouraged within two years of acceptance.</li>
            </ul></section>
            <section class="responsibility"><h3><span>02</span> IDA Home Office provides</h3><ul>
              <li>Listing on IDA’s website for approved, active agencies.</li>
              <li>Access to the Global Network-only portion of the Digital Dyslexia Library.</li>
              <li>Subscription to IDA’s “What’s Happening at IDA” newsletter.</li>
              <li>Invitation to attend three online “Sip and Chat” meetings.</li>
              <li>Bronze Organizational IDA Membership.</li>
              <li>Opportunities to advertise in IDA communications and publications.</li>
              <li>Eligibility for nomination to a voting seat on the GN Executive Committee, subject to acceptance by existing committee members.</li>
            </ul></section>
          </div>
        </article>

        <article class="detail partner" id="partner">
          <header class="detail-head">
            <div><p class="eyebrow">Leadership level</p><h2>Partner Connection</h2><p>The Global Network’s most comprehensive connection, including collaborative opportunities and governance participation.</p></div>
            <div class="fee">$750<span>Annual fee</span></div>
          </header>
          <div class="process" aria-label="Partner application process">
            <div><strong>1. Apply</strong><p>The agency completes an application.</p></div>
            <div><strong>2. Review</strong><p>The GN Executive Committee reviews and recommends it to the IDA Board.</p></div>
            <div><strong>3. Agree</strong><p>IDA and the agency sign a limited operations and usage agreement.</p></div>
          </div>
          <div class="responsibilities">
            <section class="responsibility"><h3><span>01</span> Partner responsibilities</h3><ul>
              <li>Stay up to date on IDA’s vision.</li>
              <li>Exist as a non-governmental, not-for-profit organization.</li>
              <li>Comply with the GN agreement, renewed every two years.</li>
              <li>Submit an annual report to the IDA Home Office on IDA partnerships, if applicable.</li>
              <li>Pay an annual fee of $750 USD.</li>
              <li>Comply with documented bylaws and all local regulations.</li>
              <li>Obtain Institutional Accreditation within two years of acceptance.</li>
            </ul></section>
            <section class="responsibility"><h3><span>02</span> IDA Home Office provides</h3><ul>
              <li>Listing on IDA’s website for approved, active agencies.</li>
              <li>Opportunity to partner with IDA on collaborative funded projects, with Institutional Accreditation.</li>
              <li>Subscription to IDA’s “What’s Happening at IDA” newsletter.</li>
              <li>Opportunity to be featured in IDA’s “Dyslexia Around the World” segment.</li>
              <li>Access to the Global Network-only portion of the Digital Dyslexia Library.</li>
              <li>Opportunities to advertise in IDA communications and publications.</li>
              <li>Invitation to four online “Sip and Chat” meetings annually.</li>
              <li>Bronze Organizational IDA Membership.</li>
              <li>One voting seat on the GN Executive Committee. Partner seats are automatic upon IDA National Board approval of the agency.</li>
            </ul></section>
          </div>
        </article>

        <p class="source-note"><strong>Source:</strong> Content adapted for web presentation from <a href="{{ asset('assets/dashboard/gn-central/GN Central') }}/Global Network Options.pdf">Global Network Options</a>. The original PDF remains available for reference.</p>
      </div>
    </main>
  </div>
</body>
</html>
