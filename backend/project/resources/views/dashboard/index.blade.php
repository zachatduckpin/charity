<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>IDA Global Network Central - Live Preview</title>
  <style>
    :root {
      color-scheme: light;
      --navy: #16345b;
      --blue: #2367a6;
      --teal: #1f9a9c;
      --gold: #d7a642;
      --associate: #1f9a9c;
      --associate-soft: #e7f7f5;
      --contributor: #2367a6;
      --contributor-soft: #eaf2fb;
      --partner: #d7a642;
      --partner-soft: #fff5dc;
      --ink: #182231;
      --muted: #647286;
      --line: #d8e0ea;
      --soft: #f3f7fa;
      --white: #ffffff;
      --danger: #b54343;
      --success: #287a55;
      font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    .sr-only {
      position: absolute;
      width: 1px;
      height: 1px;
      padding: 0;
      margin: -1px;
      overflow: hidden;
      clip: rect(0, 0, 0, 0);
      white-space: nowrap;
      border: 0;
    }

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      background: var(--soft);
      color: var(--ink);
    }

    .shell {
      min-height: 100vh;
      display: grid;
      grid-template-columns: 260px minmax(0, 1fr);
    }

    .sidebar {
      background: linear-gradient(180deg, #16345b, #102846);
      color: var(--white);
      padding: 22px 18px;
      display: flex;
      flex-direction: column;
      gap: 24px;
      overflow-y: auto;
    }

    .brand {
      display: flex;
      align-items: center;
      gap: 12px;
      min-width: 0;
    }

    .brand-logo {
      width: 46px;
      height: 46px;
      border-radius: 8px;
      object-fit: contain;
      background: var(--white);
      padding: 4px;
      flex: 0 0 auto;
    }

    .brand strong {
      display: block;
      font-size: 15px;
      line-height: 1.2;
    }

    .brand span {
      display: block;
      color: #bfd0e2;
      font-size: 12px;
      margin-top: 3px;
    }

    .nav {
      display: grid;
      gap: 6px;
    }

    .nav a,
    .nav-toggle {
      color: #d9e5f1;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 11px;
      border-radius: 6px;
      font-size: 14px;
      border: 0;
      background: transparent;
      font: inherit;
      text-align: left;
      cursor: pointer;
      width: 100%;
    }

    .nav a.active,
    .nav a:hover,
    .nav-toggle:hover,
    .nav-toggle.is-open {
      background: rgba(255, 255, 255, 0.14);
      color: var(--white);
      box-shadow: inset 3px 0 0 var(--gold);
    }

    .nav-label {
      flex: 1;
    }

    .nav-caret {
      color: #bfd0e2;
      font-size: 11px;
      transition: transform 160ms ease;
    }

    .nav-toggle.is-open .nav-caret {
      transform: rotate(90deg);
      color: var(--gold);
    }

    .nav-sub {
      display: grid;
      gap: 9px;
      margin: -2px 0 7px 33px;
    }

    .nav-sub[hidden] {
      display: none;
    }

    .nav-sub a {
      min-height: 28px;
      padding: 6px 9px;
      border-radius: 6px;
      color: #c7d7e8;
      font-size: 12px;
      background: rgba(255, 255, 255, 0.06);
    }

    .nav-sub a:hover,
    .nav-sub a.is-selected {
      color: var(--white);
      background: rgba(255, 255, 255, 0.12);
      box-shadow: none;
    }

    .nav-nested summary {
      list-style: none;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 8px;
      min-height: 28px;
      padding: 6px 9px;
      border-radius: 6px;
      color: #c7d7e8;
      background: rgba(255,255,255,.06);
      font-size: 12px;
    }

    .nav-nested summary::-webkit-details-marker { display: none; }
    .nav-nested summary::after { content: "›"; margin-left: auto; transition: transform 160ms ease; }
    .nav-nested[open] summary::after { transform: rotate(90deg); color: var(--gold); }
    .nav-nested summary:hover,
    .nav-nested[open] summary { color: var(--white); background: rgba(255,255,255,.12); }
    .nav-nested-links { display: grid; gap: 6px; margin: 6px 0 2px 14px; }

    /* Color-coded glass navigation */
    .nav-toggle {
      position: relative;
      border: 1px solid transparent;
      background: transparent;
      backdrop-filter: blur(12px);
      box-shadow: none;
      transition: transform 140ms ease, box-shadow 180ms ease, background 180ms ease;
    }
    .nav-toggle[aria-controls="membership-levels"],
    .nav-toggle[aria-controls="resource-sections"] { background: transparent; }
    .nav-toggle[aria-controls="membership-levels"]:hover,
    .nav-toggle[aria-controls="membership-levels"].is-open { background: linear-gradient(135deg, rgba(31,154,156,.46), rgba(31,154,156,.17)); box-shadow: inset 3px 0 0 var(--teal), 0 9px 20px rgba(3,15,30,.23); }
    .nav-toggle[aria-controls="resource-sections"]:hover,
    .nav-toggle[aria-controls="resource-sections"].is-open { background: linear-gradient(135deg, rgba(35,103,166,.52), rgba(215,166,66,.15)); box-shadow: inset 3px 0 0 var(--gold), 0 9px 20px rgba(3,15,30,.23); }
    .nav-toggle:active, .nav-nested summary:active { transform: translateY(2px) scale(.985); box-shadow: inset 0 3px 8px rgba(0,0,0,.22); }
    .nav-nested summary { border: 1px solid rgba(215,166,66,.24); background: linear-gradient(135deg, rgba(215,166,66,.17), rgba(35,103,166,.16)); box-shadow: inset 0 1px 0 rgba(255,255,255,.08), 0 5px 12px rgba(3,15,30,.14); transition: transform 140ms ease, background 180ms ease, box-shadow 180ms ease; }
    .nav-nested[open] summary { background: linear-gradient(135deg, rgba(215,166,66,.32), rgba(35,103,166,.30)); box-shadow: inset 3px 0 0 var(--gold), 0 8px 18px rgba(3,15,30,.20); }
    .nav a.accreditation-main { border: 1px solid rgba(31,154,156,.25); background: linear-gradient(135deg, rgba(31,154,156,.24), rgba(35,103,166,.12)); box-shadow: inset 3px 0 0 var(--gold), 0 7px 16px rgba(3,15,30,.16); }
    .nav a.accreditation-main:hover { background: linear-gradient(135deg, rgba(31,154,156,.46), rgba(35,103,166,.24)); box-shadow: inset 3px 0 0 var(--gold), 0 9px 20px rgba(3,15,30,.23); }

    .sidebar-note {
      margin-top: auto;
      padding: 14px;
      border: 1px solid rgba(255, 255, 255, 0.18);
      border-radius: 8px;
      background: rgba(255, 255, 255, 0.10);
      font-size: 12px;
      line-height: 1.5;
      color: #d7e2ee;
    }

    .main {
      min-width: 0;
    }

    .topbar {
      height: 52px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      padding: 0 28px;
      background: var(--white);
      border-bottom: 1px solid var(--line);
    }

    .topbar h1 {
      margin: 0;
      font-size: 16px;
      line-height: 1.25;
      letter-spacing: 0;
    }

    .topbar p {
      margin: 3px 0 0;
      color: var(--muted);
      font-size: 13px;
    }

    .profile {
      display: flex;
      align-items: center;
      gap: 10px;
      color: var(--muted);
      font-size: 13px;
      white-space: nowrap;
    }

    .avatar {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      display: grid;
      place-items: center;
      background: linear-gradient(135deg, #2367a6, #1f9a9c);
      color: var(--white);
      font-weight: 800;
    }

    .content {
      padding: 28px;
      display: grid;
      gap: 22px;
    }

    .hero {
      min-height: 258px;
      display: grid;
      align-items: center;
      padding: 28px;
      color: var(--white);
      background:
        linear-gradient(90deg, rgba(22, 52, 91, 0.94), rgba(22, 52, 91, 0.70), rgba(31, 154, 156, 0.34)),
        url("{{ asset('assets/dashboard/gn-central/preview-assets') }}/ida-gn-conference-login.jpg") center / cover;
      border-bottom: 5px solid var(--gold);
      border-radius: 8px;
    }

    .hero h2 {
      margin: 0;
      max-width: 760px;
      font-size: 34px;
      line-height: 1.08;
      letter-spacing: 0;
    }

    .hero p {
      margin: 12px 0 0;
      max-width: 720px;
      color: #eaf2f9;
      font-size: 15px;
      line-height: 1.6;
    }

    .hero-actions {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-top: 20px;
    }

    .hero-button {
      min-height: 40px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 0 14px;
      border-radius: 7px;
      color: var(--navy);
      background: var(--gold);
      text-decoration: none;
      font-size: 13px;
      font-weight: 800;
    }

    .hero-button.secondary {
      color: var(--white);
      background: rgba(255, 255, 255, 0.16);
      border: 1px solid rgba(255, 255, 255, 0.28);
    }

    .metrics {
      display: grid;
      grid-template-columns: repeat(4, minmax(0, 1fr));
      gap: 14px;
    }

    .metric,
    .panel,
    .table-wrap {
      background: var(--white);
      border: 1px solid var(--line);
      border-radius: 8px;
    }

    .metric {
      padding: 18px;
      min-height: 118px;
      display: grid;
      gap: 8px;
      box-shadow: 0 8px 24px rgba(22, 52, 91, 0.05);
    }

    a.metric {
      color: inherit;
      text-decoration: none;
      cursor: pointer;
      transition: transform 150ms ease, box-shadow 180ms ease, filter 180ms ease;
    }

    a.metric:hover,
    a.metric:focus-visible {
      transform: translateY(-3px);
      box-shadow: 0 14px 30px rgba(22, 52, 91, 0.18);
      filter: brightness(1.06);
      outline: none;
    }

    a.metric:focus-visible {
      box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.9), 0 0 0 7px rgba(35, 103, 166, 0.45), 0 14px 30px rgba(22, 52, 91, 0.18);
    }

    a.metric:active {
      transform: translateY(1px) scale(0.99);
      box-shadow: 0 5px 14px rgba(22, 52, 91, 0.16);
    }

    .metric.level-associate {
      background: linear-gradient(135deg, #1f9a9c 0%, #14777a 100%);
      border-color: rgba(31, 154, 156, 0.35);
    }

    .metric.level-contributor {
      background: linear-gradient(135deg, #2367a6 0%, #174d82 100%);
      border-color: rgba(35, 103, 166, 0.35);
    }

    .metric.level-partner {
      background: linear-gradient(135deg, #d7a642 0%, #aa7b19 100%);
      border-color: rgba(215, 166, 66, 0.42);
    }

    .metric span {
      color: var(--muted);
      font-size: 13px;
    }

    .metric strong {
      font-size: 30px;
      line-height: 1;
      color: var(--navy);
    }

    .metric small {
      color: var(--success);
      font-size: 12px;
    }

    .metric.level-associate small {
      color: rgba(255, 255, 255, 0.84);
    }

    .metric.level-contributor small {
      color: rgba(255, 255, 255, 0.84);
    }

    .metric.level-partner small {
      color: rgba(255, 255, 255, 0.86);
    }

    .metric.level-associate span,
    .metric.level-contributor span,
    .metric.level-partner span {
      color: rgba(255, 255, 255, 0.82);
    }

    .metric.level-associate strong,
    .metric.level-contributor strong,
    .metric.level-partner strong {
      color: #ffffff;
    }

    .health-dashboard {
      padding: 22px;
      border: 1px solid #d3dfeb;
      border-radius: 12px;
      background: linear-gradient(150deg, #ffffff 0%, #f5f9fc 100%);
      box-shadow: 0 12px 34px rgba(22, 52, 91, 0.08);
    }

    .health-head {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      gap: 20px;
      margin-bottom: 18px;
    }

    .health-head h2 {
      margin: 0;
      color: var(--navy);
      font-size: 22px;
    }

    .health-head p {
      max-width: 720px;
      margin: 6px 0 0;
      color: var(--muted);
      font-size: 13px;
      line-height: 1.55;
    }

    .health-badge {
      flex: 0 0 auto;
      padding: 7px 11px;
      border: 1px solid rgba(31, 154, 156, 0.28);
      border-radius: 999px;
      color: #0f6f70;
      background: var(--associate-soft);
      font-size: 11px;
      font-weight: 850;
      letter-spacing: 0.04em;
      text-transform: uppercase;
    }

    .health-kpis {
      display: grid;
      grid-template-columns: repeat(4, minmax(0, 1fr));
      gap: 12px;
      margin-bottom: 14px;
    }

    .health-kpi {
      min-height: 150px;
      padding: 16px;
      border: 1px solid #dce5ee;
      border-radius: 10px;
      background: rgba(255, 255, 255, 0.92);
      box-shadow: 0 8px 20px rgba(22, 52, 91, 0.06);
      transition: transform 160ms ease, box-shadow 180ms ease;
    }

    .health-kpi:hover {
      transform: translateY(-3px);
      box-shadow: 0 13px 26px rgba(22, 52, 91, 0.12);
    }

    .health-kpi-top {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 8px;
    }

    .health-kpi-label {
      color: var(--muted);
      font-size: 11px;
      font-weight: 850;
      letter-spacing: 0.055em;
      text-transform: uppercase;
    }

    .health-icon {
      display: grid;
      place-items: center;
      width: 30px;
      height: 30px;
      border-radius: 9px;
      color: var(--blue);
      background: var(--contributor-soft);
      font-size: 15px;
      font-weight: 900;
    }

    .health-kpi strong {
      display: block;
      margin-top: 10px;
      color: var(--navy);
      font-size: 29px;
      line-height: 1;
    }

    .health-kpi small {
      display: block;
      min-height: 30px;
      margin-top: 7px;
      color: #607086;
      font-size: 11px;
      line-height: 1.4;
    }

    .kpi-progress {
      height: 7px;
      margin-top: 10px;
      overflow: hidden;
      border-radius: 999px;
      background: #e7edf3;
    }

    .kpi-progress span {
      display: block;
      height: 100%;
      border-radius: inherit;
      background: linear-gradient(90deg, var(--teal), var(--blue));
    }

    .kpi-foot {
      display: flex;
      justify-content: space-between;
      margin-top: 6px;
      color: var(--muted);
      font-size: 10px;
      font-weight: 750;
    }

    .kpi-alert strong {
      color: #a96d12;
    }

    .kpi-alert .health-icon {
      color: #946714;
      background: var(--partner-soft);
    }

    .health-analytics {
      display: grid;
      grid-template-columns: minmax(0, 1.15fr) minmax(0, 0.85fr) minmax(0, 1fr);
      gap: 12px;
    }

    .analytic-card {
      position: relative;
      min-width: 0;
      overflow: hidden;
      padding: 17px;
      border: 1px solid #dce5ee;
      border-radius: 10px;
      background: #ffffff;
      box-shadow: 0 8px 20px rgba(22, 52, 91, 0.05);
      transition: transform 170ms ease, border-color 180ms ease, box-shadow 190ms ease, background 190ms ease;
    }

    .analytic-card::before {
      content: "";
      position: absolute;
      inset: 0 0 auto;
      height: 3px;
      opacity: 0;
      background: linear-gradient(90deg, var(--teal), var(--blue), var(--gold));
      transform: scaleX(.35);
      transform-origin: left;
      transition: opacity 170ms ease, transform 220ms ease;
    }

    .analytic-card:hover,
    .analytic-card:focus-within,
    .analytic-card:focus-visible {
      transform: translateY(-4px);
      border-color: rgba(35, 103, 166, 0.28);
      background: linear-gradient(150deg, #ffffff 0%, #f6fbfd 100%);
      box-shadow: 0 16px 31px rgba(22, 52, 91, 0.14);
      outline: none;
    }

    .analytic-card:hover::before,
    .analytic-card:focus-within::before,
    .analytic-card:focus-visible::before {
      opacity: 1;
      transform: scaleX(1);
    }

    .analytic-title {
      display: flex;
      justify-content: space-between;
      gap: 12px;
      align-items: flex-start;
    }

    .analytic-title h3 {
      margin: 0;
      color: var(--navy);
      font-size: 15px;
    }

    .analytic-title p {
      margin: 4px 0 0;
      color: var(--muted);
      font-size: 10.5px;
    }

    .trend-chip {
      padding: 5px 8px;
      border-radius: 999px;
      color: #287a55;
      background: #e9f6ef;
      font-size: 11px;
      font-weight: 850;
      white-space: nowrap;
    }

    .applications-chart {
      width: 100%;
      height: 170px;
      margin-top: 8px;
      transition: transform 190ms ease, filter 190ms ease;
    }

    .analytic-card:hover .applications-chart,
    .analytic-card:focus-within .applications-chart {
      transform: translateY(-2px) scale(1.012);
      filter: saturate(1.12);
    }

    .analytic-link {
      display: inline-flex;
      margin-top: 8px;
      color: var(--blue);
      font-size: 11px;
      font-weight: 800;
      text-decoration: none;
    }

    .analytic-link:hover {
      text-decoration: underline;
    }

    .tier-visual {
      display: grid;
      grid-template-columns: 126px 1fr;
      gap: 15px;
      align-items: center;
      margin-top: 18px;
    }

    .tier-donut {
      position: relative;
      width: 126px;
      height: 126px;
      border-radius: 50%;
      background: conic-gradient(var(--associate) 0 58.82%, var(--contributor) 58.82% 94.12%, var(--partner) 94.12% 100%);
      box-shadow: inset 0 0 0 1px rgba(22, 52, 91, 0.08);
      transition: transform 260ms ease, box-shadow 190ms ease;
    }

    .analytic-card:hover .tier-donut,
    .analytic-card:focus-within .tier-donut {
      transform: rotate(4deg) scale(1.035);
      box-shadow: inset 0 0 0 1px rgba(22, 52, 91, 0.08), 0 11px 23px rgba(22, 52, 91, 0.14);
    }

    .tier-donut::after {
      content: "17\A members";
      white-space: pre;
      position: absolute;
      inset: 23px;
      display: grid;
      place-items: center;
      border-radius: 50%;
      color: var(--navy);
      background: #ffffff;
      box-shadow: 0 3px 12px rgba(22, 52, 91, 0.12);
      font-size: 11px;
      font-weight: 850;
      line-height: 1.25;
      text-align: center;
    }

    .tier-legend {
      display: grid;
      gap: 9px;
    }

    .tier-legend div {
      display: grid;
      grid-template-columns: 9px 1fr auto;
      gap: 8px;
      align-items: center;
      color: #52647a;
      font-size: 11px;
    }

    .tier-legend i {
      width: 9px;
      height: 9px;
      border-radius: 50%;
    }

    .tier-legend b {
      color: var(--navy);
      font-size: 12px;
    }

    .pipeline-list {
      display: grid;
      gap: 11px;
      margin-top: 16px;
    }

    .pipeline-row {
      display: grid;
      grid-template-columns: 82px 1fr 22px;
      gap: 8px;
      align-items: center;
      color: #52647a;
      font-size: 11px;
    }

    .pipeline-bar {
      height: 9px;
      overflow: hidden;
      border-radius: 999px;
      background: #e8edf3;
    }

    .pipeline-bar span {
      display: block;
      height: 100%;
      border-radius: inherit;
      transform-origin: left;
      transition: transform 210ms ease, filter 190ms ease;
    }

    .analytic-card:hover .pipeline-bar span,
    .analytic-card:focus-within .pipeline-bar span {
      transform: scaleX(1.035);
      filter: saturate(1.16) brightness(1.02);
    }

    @@media (prefers-reduced-motion: reduce) {
      .analytic-card,
      .analytic-card::before,
      .applications-chart,
      .tier-donut,
      .pipeline-bar span {
        transition: none;
      }
    }

    .pipeline-row b {
      color: var(--navy);
      text-align: right;
    }

    .health-source {
      margin: 12px 0 0;
      color: #6c7a8b;
      font-size: 10px;
      line-height: 1.5;
    }

    .grid {
      display: grid;
      grid-template-columns: minmax(0, 1.35fr) minmax(300px, 0.65fr);
      gap: 18px;
      align-items: start;
    }

    .panel {
      padding: 20px;
    }

    .panel h3,
    .table-wrap h3 {
      margin: 0 0 14px;
      font-size: 17px;
      color: var(--navy);
    }

    .quick-actions {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 12px;
    }

    .action {
      position: relative;
      display: block;
      min-height: 96px;
      border: 1px solid var(--line);
      border-radius: 8px;
      padding: 14px 42px 14px 14px;
      background: #fbfdff;
      box-shadow: 0 6px 18px rgba(22, 52, 91, 0.04);
      color: inherit;
      text-decoration: none;
      transition: transform 150ms ease, border-color 150ms ease, box-shadow 150ms ease;
    }

    .action::after {
      content: "→";
      position: absolute;
      top: 14px;
      right: 14px;
      width: 24px;
      height: 24px;
      display: grid;
      place-items: center;
      border-radius: 7px;
      color: var(--blue);
      background: var(--contributor-soft);
      font-weight: 900;
    }

    .action:hover,
    .action:focus-visible {
      transform: translateY(-2px);
      border-color: rgba(35, 103, 166, 0.35);
      box-shadow: 0 11px 25px rgba(22, 52, 91, 0.10);
      outline: none;
    }

    .action:active {
      transform: translateY(1px);
    }

    .committee-grid {
      display: grid;
      grid-template-columns: repeat(4, minmax(0, 1fr));
      gap: 14px;
    }

    .committee-member {
      overflow: hidden;
      border: 1px solid var(--line);
      border-radius: 12px;
      background: var(--white);
      box-shadow: 0 8px 24px rgba(22, 52, 91, 0.07);
    }

    .committee-photo {
      width: 100%;
      aspect-ratio: 4 / 3;
      display: block;
      object-fit: cover;
      object-position: 50% 28%;
      background: #dce4eb;
    }

    .committee-details {
      padding: 15px;
      border-top: 4px solid var(--teal);
    }

    .committee-details strong {
      display: block;
      color: var(--navy);
      font-size: 14px;
      line-height: 1.3;
    }

    .committee-details strong a {
      color: inherit;
      text-decoration: none;
    }

    .committee-details strong a:hover {
      color: var(--blue);
      text-decoration: underline;
      text-underline-offset: 3px;
    }

    .committee-details span {
      display: block;
      margin-top: 5px;
      color: var(--muted);
      font-size: 11px;
      line-height: 1.45;
    }

    .panel-intro {
      margin: -5px 0 16px;
      max-width: 760px;
      color: var(--muted);
      font-size: 12px;
      line-height: 1.55;
    }

    .friend-card .committee-details {
      border-top-color: #7257a5;
      background: linear-gradient(180deg, #ffffff, #faf8ff);
    }

    .friend-avatar {
      display: grid;
      place-items: center;
      color: #ffffff;
      background:
        radial-gradient(circle at 72% 22%, rgba(255, 255, 255, 0.28), transparent 28%),
        linear-gradient(145deg, #173c62 0%, #7257a5 58%, #b68a35 100%);
      font-family: Georgia, "Times New Roman", serif;
      font-size: clamp(42px, 5vw, 68px);
      font-weight: 700;
      letter-spacing: 0.04em;
      text-shadow: 0 3px 12px rgba(20, 32, 60, 0.28);
    }

    .friend-label {
      display: inline-flex !important;
      width: fit-content;
      margin-top: 8px !important;
      padding: 4px 8px;
      border-radius: 999px;
      color: #62458f !important;
      background: #f0eafd;
      font-size: 9px !important;
      font-weight: 850;
      letter-spacing: .06em;
      text-transform: uppercase;
    }

    .action strong {
      display: block;
      font-size: 14px;
      margin-bottom: 6px;
    }

    .action span {
      color: var(--muted);
      font-size: 12px;
      line-height: 1.45;
    }

    .table-wrap {
      overflow: hidden;
    }

    .table-head {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 14px;
      padding: 18px 20px 0;
    }

    .table-head h3 {
      margin: 0;
    }

    .view-all-members {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      padding: 8px 12px;
      border: 1px solid rgba(35, 103, 166, 0.18);
      border-radius: 999px;
      color: var(--blue);
      background: linear-gradient(145deg, #ffffff, #edf7fa);
      box-shadow: 0 7px 16px rgba(15, 58, 95, 0.09);
      font-size: 12px;
      font-weight: 800;
      text-decoration: none;
      transition: transform 140ms ease, box-shadow 160ms ease;
    }

    .view-all-members:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 22px rgba(15, 58, 95, 0.15);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 13px;
    }

    th,
    td {
      padding: 13px 20px;
      text-align: left;
      border-top: 1px solid var(--line);
      vertical-align: middle;
    }

    th {
      color: var(--muted);
      font-weight: 700;
      background: #f8fafc;
    }

    .status {
      display: inline-flex;
      align-items: center;
      min-height: 24px;
      padding: 3px 8px;
      border-radius: 999px;
      font-size: 12px;
      font-weight: 700;
    }

    .status.good {
      background: #e8f6ef;
      color: var(--success);
    }

    .status.warn {
      background: #fff5de;
      color: #946714;
    }

    .status.risk {
      background: #fdeeee;
      color: var(--danger);
    }

    .status.tier-associate {
      border: 1px solid rgba(31, 154, 156, 0.28);
      background: var(--associate-soft);
      color: #0f6f70;
    }

    .status.tier-contributor {
      border: 1px solid rgba(35, 103, 166, 0.26);
      background: var(--contributor-soft);
      color: var(--contributor);
    }

    .status.tier-partner {
      border: 1px solid rgba(215, 166, 66, 0.36);
      background: var(--partner-soft);
      color: #946714;
    }

    .timeline {
      display: grid;
      gap: 14px;
    }

    .timeline-item {
      display: grid;
      grid-template-columns: 20px 1fr;
      gap: 10px;
    }

    .dot {
      width: 10px;
      height: 10px;
      margin-top: 5px;
      border-radius: 50%;
      background: var(--teal);
      box-shadow: 0 0 0 4px #e1f3f3;
    }

    .timeline-item strong {
      display: block;
      font-size: 13px;
      margin-bottom: 3px;
    }

    .timeline-item span {
      color: var(--muted);
      font-size: 12px;
      line-height: 1.45;
    }

    .task-list {
      display: grid;
      gap: 11px;
    }

    .task {
      display: grid;
      grid-template-columns: 1fr auto auto;
      gap: 10px;
      align-items: center;
      padding: 11px;
      border: 1px solid var(--line);
      border-radius: 8px;
      color: inherit;
      background: #fbfdff;
      text-decoration: none;
      transition: transform 140ms ease, border-color 160ms ease, box-shadow 160ms ease;
    }

    .task::after {
      content: "→";
      color: var(--blue);
      font-size: 15px;
      font-weight: 900;
    }

    .task:hover {
      transform: translateX(3px);
      border-color: rgba(35, 103, 166, 0.28);
      box-shadow: 0 8px 18px rgba(15, 58, 95, 0.10);
    }

    .task strong {
      display: block;
      font-size: 13px;
      margin-bottom: 3px;
    }

    .task span {
      display: block;
      color: var(--muted);
      font-size: 12px;
    }

    .member-groups {
      display: grid;
      grid-template-columns: 1fr;
      gap: 14px;
    }

    .member-group {
      border: 1px solid var(--line);
      border-radius: 8px;
      overflow: hidden;
      background: #fbfdff;
    }

    .member-group.level-associate {
      border-color: rgba(31, 154, 156, 0.28);
    }

    .member-group.level-contributor {
      border-color: rgba(35, 103, 166, 0.28);
    }

    .member-group.level-partner {
      border-color: rgba(215, 166, 66, 0.4);
    }

    .member-panel[hidden],
    .member-group[hidden] {
      display: none;
    }

    .member-group-header {
      display: grid;
      grid-template-columns: 42px minmax(230px, 1.45fr) minmax(120px, 0.55fr) minmax(230px, 1fr);
      gap: 18px;
      align-items: center;
      margin: 0;
      padding: 12px 16px;
      color: var(--navy);
      background: #f0f6fb;
      border-bottom: 1px solid var(--line);
    }

    .level-associate .member-group-header {
      background: var(--associate-soft);
      border-bottom-color: rgba(31, 154, 156, 0.28);
    }

    .level-contributor .member-group-header {
      background: var(--contributor-soft);
      border-bottom-color: rgba(35, 103, 166, 0.26);
    }

    .level-partner .member-group-header {
      background: var(--partner-soft);
      border-bottom-color: rgba(215, 166, 66, 0.32);
    }

    .member-group-header h4 {
      grid-column: 1 / 3;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      margin: 0;
      font-size: 14px;
    }

    .level-name {
      display: inline-flex;
      align-items: center;
      min-height: 26px;
      padding: 5px 10px;
      border-radius: 999px;
      font-size: 12px;
      font-weight: 900;
      letter-spacing: 0.06em;
      text-transform: uppercase;
    }

    .level-associate .level-name {
      background: rgba(31, 154, 156, 0.15);
      color: #0f6f70;
    }

    .level-contributor .level-name {
      background: rgba(35, 103, 166, 0.14);
      color: var(--contributor);
    }

    .level-partner .level-name {
      background: rgba(215, 166, 66, 0.2);
      color: #946714;
    }

    .member-group-header h4::before {
      content: "";
      display: inline-block;
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background: var(--blue);
      box-shadow: 0 0 0 4px rgba(35, 103, 166, 0.11);
    }

    .level-associate .member-group-header h4::before {
      background: var(--associate);
      box-shadow: 0 0 0 4px rgba(31, 154, 156, 0.13);
    }

    .level-contributor .member-group-header h4::before {
      background: var(--contributor);
      box-shadow: 0 0 0 4px rgba(35, 103, 166, 0.12);
    }

    .level-partner .member-group-header h4::before {
      background: var(--partner);
      box-shadow: 0 0 0 4px rgba(215, 166, 66, 0.17);
    }

    .member-column-label {
      color: var(--muted);
      font-size: 11px;
      font-weight: 800;
      letter-spacing: 0.08em;
      text-transform: uppercase;
    }

    .member-list {
      display: grid;
      gap: 0;
      margin: 0;
      padding: 0;
      list-style: none;
    }

    .member-list li {
      display: grid;
      grid-template-columns: 42px minmax(230px, 1.45fr) minmax(120px, 0.55fr) minmax(230px, 1fr);
      gap: 18px;
      align-items: center;
      padding: 10px 16px;
      border-top: 1px solid #e9eef5;
      font-size: 13px;
      line-height: 1.35;
    }

    .member-list li:first-child {
      border-top: 0;
    }

    .member-flag {
      display: grid;
      place-items: center;
      width: 38px;
      height: 38px;
      border: 1px solid rgba(15, 58, 95, 0.13);
      border-radius: 50%;
      background: #ffffff;
      box-shadow: 0 8px 18px rgba(15, 58, 95, 0.09);
      font-size: 22px;
      line-height: 1;
    }

    .member-flag.member-logo {
      overflow: hidden;
      padding: 3px;
    }

    .member-flag.member-logo img {
      width: 100%;
      height: 100%;
      object-fit: contain;
      border-radius: 50%;
    }

    .member-list li.wide-logo-row {
      grid-template-columns: 150px minmax(150px, 1.45fr) minmax(120px, 0.55fr) minmax(190px, 1fr);
    }

    .member-flag.member-logo.logo-wide {
      width: 146px;
      height: 56px;
      padding: 5px 8px;
      border-radius: 9px;
    }

    .member-flag.member-logo.logo-wide img {
      border-radius: 0;
    }

    .member-details strong {
      display: block;
      color: var(--navy);
      font-size: 13.5px;
    }

    .member-name-link {
      color: var(--navy);
      text-decoration: none;
      border-bottom: 1px solid rgba(11, 132, 180, 0.28);
      transition: color 0.2s ease, border-color 0.2s ease;
    }

    .member-name-link:hover {
      color: var(--blue);
      border-color: var(--gold);
    }

    .member-details {
      display: contents;
    }

    .member-country,
    .member-contact {
      display: block;
      color: var(--muted);
      font-size: 12px;
    }

    .member-contact {
      color: #50657a;
    }

    @@media (max-width: 1180px) {
      .member-group-header,
      .member-list li {
        grid-template-columns: 42px minmax(210px, 1fr) minmax(95px, 0.45fr) minmax(190px, 0.95fr);
        gap: 14px;
      }
    }

    @@media (max-width: 980px) {
      .shell {
        grid-template-columns: 1fr;
      }

      .sidebar {
        display: block;
      }

      .nav,
      .sidebar-note {
        display: none;
      }

      .metrics,
      .health-kpis,
      .health-analytics,
      .grid,
      .member-groups,
      .quick-actions {
        grid-template-columns: 1fr;
      }

      .health-head {
        align-items: flex-start;
        flex-direction: column;
      }

      .committee-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
      }

      .member-list li {
        grid-template-columns: 42px 1fr;
        gap: 10px 12px;
      }

      .member-list li.wide-logo-row {
        grid-template-columns: 1fr;
      }

      .member-flag.member-logo.logo-wide {
        width: min(100%, 320px);
        height: 86px;
      }

      .member-group-header {
        grid-template-columns: 1fr 1fr;
        gap: 6px 14px;
      }

      .member-group-header h4 {
        grid-column: 1 / -1;
      }

      .member-details {
        display: grid;
        gap: 3px;
      }
    }

    @@media (max-width: 620px) {
      .topbar {
        height: auto;
        align-items: flex-start;
        flex-direction: column;
        padding: 18px;
      }

      .content {
        padding: 16px;
      }

      .hero {
        padding: 22px;
      }

      .hero h2 {
        font-size: 27px;
      }

      .health-dashboard {
        padding: 16px;
      }

      .tier-visual {
        grid-template-columns: 1fr;
        justify-items: center;
        text-align: left;
      }

      .tier-legend {
        width: 100%;
      }

      th,
      td {
        padding: 11px;
      }
    }
  </style>
  <link rel="stylesheet" href="{{ asset('assets/dashboard/gn-central/preview-assets') }}/gn-central-navigation.css">
</head>
<body>
  <div class="shell">
    <aside class="sidebar" aria-label="Primary navigation">
      <div class="brand">
        <img class="brand-logo" src="{{ asset('assets/dashboard/gn-central/preview-assets') }}/ida-global-network-logo.png" alt="IDA Global Network logo">
        <div>
          <strong>Global Network Central</strong>
          <span>International Dyslexia Association</span>
        </div>
      </div>

      <x-dashboard.flat-nav />

      <div class="sidebar-note">
        Secure central workspace for coordinating IDA Global Network programs, partners, events, and resources.
      </div>
    </aside>

    <main class="main">
      <section class="content">
        <section class="metrics" aria-label="Key network metrics">
          <div class="metric">
            <span>Current GN Members</span>
            <strong>17</strong>
            <small>Current GN roster</small>
          </div>
          <a class="metric level-associate" href="#associate-members" data-member-target="associate-members" aria-label="View Associate members">
            <span>Associates</span>
            <strong>10</strong>
            <small>View Associate members →</small>
          </a>
          <a class="metric level-contributor" href="#contributor-members" data-member-target="contributor-members" aria-label="View Contributor members">
            <span>Contributors</span>
            <strong>6</strong>
            <small>View Contributor members →</small>
          </a>
          <a class="metric level-partner" href="#partner-members" data-member-target="partner-members" aria-label="View Partner members">
            <span>Partners</span>
            <strong>1</strong>
            <small>View Partner members →</small>
          </a>
        </section>

        <section class="health-dashboard" aria-labelledby="health-title">
          <div class="health-head">
            <div>
              <h2 id="health-title">Programme Health &amp; KPI Trends</h2>
            </div>
            <span class="health-badge">August 2026 snapshot</span>
          </div>

          <div class="health-kpis" aria-label="Programme health indicators">
            <article class="health-kpi">
              <div class="health-kpi-top"><span class="health-kpi-label">Membership target</span><span class="health-icon" aria-hidden="true">◎</span></div>
              <strong>17 <span class="sr-only">members</span></strong>
              <small>Current members against a working target of 20.</small>
              <div class="kpi-progress" role="progressbar" aria-label="Membership target progress" aria-valuemin="0" aria-valuemax="20" aria-valuenow="17"><span style="width:85%"></span></div>
              <div class="kpi-foot"><span>85% achieved</span><span>3 to target</span></div>
            </article>

            <article class="health-kpi">
              <div class="health-kpi-top"><span class="health-kpi-label">Geographic reach</span><span class="health-icon" aria-hidden="true">◇</span></div>
              <strong>16</strong>
              <small>Countries and territories represented; working target 18.</small>
              <div class="kpi-progress" role="progressbar" aria-label="Geographic reach target progress" aria-valuemin="0" aria-valuemax="18" aria-valuenow="16"><span style="width:88.9%"></span></div>
              <div class="kpi-foot"><span>89% achieved</span><span>2 to target</span></div>
            </article>

            <article class="health-kpi">
              <div class="health-kpi-top"><span class="health-kpi-label">Pipeline engagement</span><span class="health-icon" aria-hidden="true">↗</span></div>
              <strong>75%</strong>
              <small>9 of 12 records have moved beyond the unopened stage.</small>
              <div class="kpi-progress" role="progressbar" aria-label="Application pipeline engagement" aria-valuemin="0" aria-valuemax="12" aria-valuenow="9"><span style="width:75%"></span></div>
              <div class="kpi-foot"><span>9 progressed</span><span>3 new</span></div>
            </article>

            <article class="health-kpi kpi-alert">
              <div class="health-kpi-top"><span class="health-kpi-label">Decision readiness</span><span class="health-icon" aria-hidden="true">!</span></div>
              <strong>4</strong>
              <small>Applications ready for decision; one record is currently blocked.</small>
              <div class="kpi-progress" role="progressbar" aria-label="Decision-ready applications" aria-valuemin="0" aria-valuemax="12" aria-valuenow="4"><span style="width:33.3%;background:linear-gradient(90deg,#d7a642,#b77d16)"></span></div>
              <div class="kpi-foot"><span>33% of pipeline</span><span>1 blocked</span></div>
            </article>
          </div>

          <div class="health-analytics">
            <article class="analytic-card" tabindex="0" aria-label="Application Intake Trend analytics panel">
              <div class="analytic-title">
                <div><h3>Application Intake Trend</h3><p>May versus June 2026</p></div>
                <span class="trend-chip">↑ 40%</span>
              </div>
              <canvas class="applications-chart" id="applicationsTrendChart" role="img" aria-label="Application records increased from five in May to seven in June 2026"></canvas>
              <a class="analytic-link" href="{{ route('dashboard.membership-applications.index') }}">Open application workspace →</a>
            </article>

            <article class="analytic-card" tabindex="0" aria-label="Current Member Mix analytics panel">
              <div class="analytic-title"><div><h3>Current Member Mix</h3><p>Distribution across membership tiers</p></div></div>
              <div class="tier-visual">
                <div class="tier-donut" role="img" aria-label="17 members: 10 Associates, 6 Contributors and 1 Partner"></div>
                <div class="tier-legend" aria-label="Membership tier legend">
                  <div><i style="background:var(--associate)"></i><span>Associates</span><b>10</b></div>
                  <div><i style="background:var(--contributor)"></i><span>Contributors</span><b>6</b></div>
                  <div><i style="background:var(--partner)"></i><span>Partners</span><b>1</b></div>
                </div>
              </div>
              <a class="analytic-link" href="#associate-members" data-member-target="associate-members">Explore members by tier →</a>
            </article>

            <article class="analytic-card" tabindex="0" aria-label="Application Pipeline analytics panel">
              <div class="analytic-title"><div><h3>Application Pipeline</h3><p>Current position of 12 application records</p></div></div>
              <div class="pipeline-list">
                <div class="pipeline-row"><span>New</span><div class="pipeline-bar"><span style="width:25%;background:#8ba0b5"></span></div><b>3</b></div>
                <div class="pipeline-row"><span>In review</span><div class="pipeline-bar"><span style="width:33.3%;background:var(--teal)"></span></div><b>4</b></div>
                <div class="pipeline-row"><span>Decision</span><div class="pipeline-bar"><span style="width:33.3%;background:var(--gold)"></span></div><b>4</b></div>
                <div class="pipeline-row"><span>Complete</span><div class="pipeline-bar"><span style="width:8.3%;background:var(--success)"></span></div><b>1</b></div>
              </div>
              <a class="analytic-link" href="{{ route('dashboard.membership-applications.index') }}">Review records and decisions →</a>
            </article>
          </div>

          <p class="health-source"><strong>Data note:</strong> Member and tier totals reflect the current GN roster. Application indicators reflect the 12 records in the current prototype workspace. Membership and geographic targets are working planning targets and should be updated when the Executive Committee approves formal annual KPIs. Recommended next data points include renewals, member engagement, review turnaround time, accreditation-stage movement, regional coverage and member retention.</p>
        </section>

        <section class="panel member-panel" id="member-panel" hidden>
          <h3>Network Members by Membership Level</h3>
          <div class="member-groups">
            <div class="member-group level-associate" id="associate-members" hidden>
              <div class="member-group-header">
                <h4><span class="level-name">Associate</span></h4>
                <span class="member-column-label">Country</span>
                <span class="member-column-label">Main Contact</span>
              </div>
              <ul class="member-list">
                <li class="wide-logo-row"><span class="member-flag member-logo logo-wide"><img src="{{ asset('assets/dashboard/gn-central/preview-assets') }}/members/africa-dyslexia-organisation-logo.png" alt="Africa Dyslexia Organisation logo"></span><span class="member-details"><strong><a class="member-name-link" href="{{ route('dashboard.member-profile.show', ['member' => 'africa-dyslexia-organization']) }}">Africa Dyslexia Organization</a></strong><span class="member-country">Ghana</span><span class="member-contact">Rosalin Abigail Kyere-Nartey · Founder and Executive Director</span></span></li>
                <li><span class="member-flag" aria-hidden="true">🇦🇺</span><span class="member-details"><strong><a class="member-name-link" href="{{ route('dashboard.member-profile.show', ['member' => 'australian-dyslexia-association']) }}">Australian Dyslexia Association</a></strong><span class="member-country">Australia</span><span class="member-contact">Ms. Jodi Clements</span></span></li>
                <li class="wide-logo-row"><span class="member-flag member-logo logo-wide"><img src="{{ asset('assets/dashboard/gn-central/preview-assets') }}/members/bellavista-share-logo.png" alt="Bellavista S.H.A.R.E. logo" style="width:230%;height:230%;max-width:none"></span><span class="member-details"><strong><a class="member-name-link" href="{{ route('dashboard.member-profile.show', ['member' => 'bellavista-school']) }}">Bellavista School</a></strong><span class="member-country">South Africa</span><span class="member-contact">Ms. Annelize Clark Hendry · Director of Programmes</span></span></li>
                <li><span class="member-flag member-logo"><img src="{{ asset('assets/dashboard/gn-central/preview-assets') }}/members/botswana-dyslexia-logo.jpg" alt="Dyslexia and Social Support Services Botswana logo"></span><span class="member-details"><strong><a class="member-name-link" href="{{ route('dashboard.member-profile.show', ['member' => 'dyslexia-and-social-support-services-botswana']) }}">Dyslexia and Social Support Services Botswana</a></strong><span class="member-country">Botswana</span><span class="member-contact">Ms. Letang Giro</span></span></li>
                <li class="wide-logo-row"><span class="member-flag member-logo logo-wide"><img src="{{ asset('assets/dashboard/gn-central/preview-assets') }}/members/dyslexia-ireland-logo.png" alt="Dyslexia Ireland logo"></span><span class="member-details"><strong><a class="member-name-link" href="{{ route('dashboard.member-profile.show', ['member' => 'dyslexia-ireland']) }}">Dyslexia Ireland</a></strong><span class="member-country">Ireland</span><span class="member-contact">Ms. Rosie Bissett · CEO</span></span></li>
                <li class="wide-logo-row"><span class="member-flag member-logo logo-wide"><img src="{{ asset('assets/dashboard/gn-central/preview-assets') }}/members/dyslexia-association-of-indonesia-logo.jpeg" alt="Dyslexia Association of Indonesia logo"></span><span class="member-details"><strong><a class="member-name-link" href="{{ route('dashboard.member-profile.show', ['member' => 'dyslexia-association-of-indonesia']) }}">Dyslexia Association of Indonesia</a></strong><span class="member-country">Indonesia</span><span class="member-contact">Dr. Kristiantini Dewi · Chairperson</span></span></li>
                <li><span class="member-flag" aria-hidden="true">🇬🇧</span><span class="member-details"><strong><a class="member-name-link" href="{{ route('dashboard.member-profile.show', ['member' => 'dyslexia-science']) }}">Dyslexia Science</a></strong><span class="member-country">Scotland</span><span class="member-contact">Ms. Gillian Evans</span></span></li>
                <li><span class="member-flag member-logo"><img src="{{ asset('assets/dashboard/gn-central/preview-assets') }}/members/fana-ethiopia-logo.jpg" alt="FANA-Ethiopia logo"></span><span class="member-details"><strong><a class="member-name-link" href="{{ route('dashboard.member-profile.show', ['member' => 'fana-ethiopia']) }}">FANA-Ethiopia</a></strong><span class="member-country">Ethiopia</span><span class="member-contact">Dr. Abebayehu Messele Mekonnen</span></span></li>
                <li class="wide-logo-row"><span class="member-flag member-logo logo-wide"><img src="{{ asset('assets/dashboard/gn-central/preview-assets') }}/members/kenya-dyslexia-organization-logo.jpg" alt="Dyslexia Organisation Kenya logo"></span><span class="member-details"><strong><a class="member-name-link" href="{{ route('dashboard.member-profile.show', ['member' => 'dyslexia-organization-kenya']) }}">Kenya Dyslexia Association</a></strong><span class="member-country">Kenya</span><span class="member-contact">Phyllis Munyi</span></span></li>
                <li><span class="member-flag" aria-hidden="true">🇹🇷</span><span class="member-details"><strong><a class="member-name-link" href="{{ route('dashboard.member-profile.show', ['member' => 'turkey-dyslexia-foundation']) }}">Turkey Dyslexia Foundation</a></strong><span class="member-country">Turkey</span><span class="member-contact">Tuncer Yavuz</span></span></li>
              </ul>
            </div>
            <div class="member-group level-contributor" id="contributor-members" hidden>
              <div class="member-group-header">
                <h4><span class="level-name">Contributor</span></h4>
                <span class="member-column-label">Country</span>
                <span class="member-column-label">Main Contact</span>
              </div>
              <ul class="member-list">
                <li><span class="member-flag" aria-hidden="true">🇧🇷</span><span class="member-details"><strong><a class="member-name-link" href="{{ route('dashboard.member-profile.show', ['member' => 'brazilian-dyslexia-association']) }}">Brazilian Dyslexia Association</a></strong><span class="member-country">Brazil</span><span class="member-contact">Ms. Angela Nico</span></span></li>
                <li><span class="member-flag member-logo"><img src="{{ asset('assets/dashboard/gn-central/preview-assets') }}/members/ccet-logo.png" alt="Centre for Child Evaluation &amp; Teaching logo"></span><span class="member-details"><strong><a class="member-name-link" href="{{ route('dashboard.member-profile.show', ['member' => 'center-for-child-evaluation-and-teaching-kuwait']) }}">Centre for Child Evaluation &amp; Teaching (CCET)</a></strong><span class="member-country">Kuwait</span><span class="member-contact">Dr. Abir Al-Sharhan · Assistant Director for Technical Affairs</span></span></li>
                <li><span class="member-flag" aria-hidden="true">🇮🇳</span><span class="member-details"><strong><a class="member-name-link" href="{{ route('dashboard.member-profile.show', ['member' => 'dr-anjali-morris-education-health-foundation']) }}">Dr. Anjali Morris Education & Health Foundation</a></strong><span class="member-country">India</span><span class="member-contact">Ms. Tanima Sarkar</span></span></li>
                <li><span class="member-flag member-logo"><img src="{{ asset('assets/dashboard/gn-central/preview-assets') }}/members/dyslexia-foundation-uk-logo.jpg" alt="Dyslexia Foundation UK logo"></span><span class="member-details"><strong><a class="member-name-link" href="{{ route('dashboard.member-profile.show', ['member' => 'dyslexia-foundation']) }}">Dyslexia Foundation</a></strong><span class="member-country">England</span><span class="member-contact">Mr. Steve O'Brien</span></span></li>
                <li class="wide-logo-row"><span class="member-flag member-logo logo-wide"><img src="{{ asset('assets/dashboard/gn-central/preview-assets') }}/members/maharashtra-dyslexia-association-logo.jpg" alt="Maharashtra Dyslexia Association logo"></span><span class="member-details"><strong><a class="member-name-link" href="{{ route('dashboard.member-profile.show', ['member' => 'maharashtra-dyslexia-association']) }}">Maharashtra Dyslexia Association</a></strong><span class="member-country">India</span><span class="member-contact">Ms. Kate Currawalla · CEO</span></span></li>
                <li class="wide-logo-row"><span class="member-flag member-logo logo-wide"><img src="{{ asset('assets/dashboard/gn-central/preview-assets') }}/members/pathways-foundation-logo.png" alt="Pathways Foundation logo"></span><span class="member-details"><strong><a class="member-name-link" href="{{ route('dashboard.member-profile.show', ['member' => 'pathways-foundation-ltd']) }}">Pathways Foundation Ltd.</a></strong><span class="member-country">Hong Kong</span><span class="member-contact">Ms. Lucille Wong · CEO</span></span></li>
              </ul>
            </div>
            <div class="member-group level-partner" id="partner-members" hidden>
              <div class="member-group-header">
                <h4><span class="level-name">Partner</span></h4>
                <span class="member-column-label">Country</span>
                <span class="member-column-label">Main Contact</span>
              </div>
              <ul class="member-list">
                <li><span class="member-flag" aria-hidden="true">🇸🇬</span><span class="member-details"><strong><a class="member-name-link" href="{{ route('dashboard.member-profile.show', ['member' => 'dyslexia-association-of-singapore']) }}">Dyslexia Association of Singapore</a></strong><span class="member-country">Singapore</span><span class="member-contact">Mr. Lee Siang</span></span></li>
              </ul>
            </div>
          </div>
        </section>

        <section class="grid">
          <div class="table-wrap">
            <div class="table-head">
              <h3>Current GN Members</h3>
              <a class="view-all-members" href="{{ route('dashboard.members.index') }}">View all members <span aria-hidden="true">→</span></a>
            </div>
            <table>
              <thead>
                <tr>
                  <th>Organization</th>
                  <th>Region</th>
                  <th>Level</th>
                  <th>Main Contact</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Africa Dyslexia Organization</td>
                  <td>Ghana</td>
                  <td><span class="status tier-associate">Associate</span></td>
                  <td>Rosalin Abigail Kyere-Nartey</td>
                </tr>
                <tr>
                  <td>Bellavista School</td>
                  <td>South Africa</td>
                  <td><span class="status tier-associate">Associate</span></td>
                  <td>Ms. Annelize Clark Hendry</td>
                </tr>
                <tr>
                  <td>Brazilian Dyslexia Association</td>
                  <td>Brazil</td>
                  <td><span class="status tier-contributor">Contributor</span></td>
                  <td>Ms. Angela Nico</td>
                </tr>
                <tr>
                  <td>Dyslexia Association of Singapore</td>
                  <td>Singapore</td>
                  <td><span class="status tier-partner">Partner</span></td>
                  <td>Mr. Lee Siang</td>
                </tr>
                <tr>
                  <td>Dyslexia Ireland</td>
                  <td>Ireland</td>
                  <td><span class="status tier-associate">Associate</span></td>
                  <td>Ms. Rosie Bissett</td>
                </tr>
                <tr>
                  <td>Dyslexia Association of Indonesia</td>
                  <td>Indonesia</td>
                  <td><span class="status tier-associate">Associate</span></td>
                  <td>Dr. Kristiantini Dewi</td>
                </tr>
              </tbody>
            </table>
          </div>

          <aside class="panel">
            <h3>Priority Queue</h3>
            <div class="task-list">
              <a class="task" href="{{ route('dashboard.priority-queue.index') }}#partner-applications">
                <div>
                  <strong>3 partner applications</strong>
                  <span>Awaiting first review</span>
                </div>
                <span class="status warn">Review</span>
              </a>
              <a class="task" href="{{ route('dashboard.priority-queue.index') }}#event-submissions">
                <div>
                  <strong>5 event submissions</strong>
                  <span>Need publishing decision</span>
                </div>
                <span class="status good">Ready</span>
              </a>
              <a class="task" href="{{ route('dashboard.priority-queue.index') }}#resource-updates">
                <div>
                  <strong>2 resource updates</strong>
                  <span>Central toolkit refresh</span>
                </div>
                <span class="status risk">Pending</span>
              </a>
            </div>
          </aside>
        </section>

        <section class="panel" aria-labelledby="committee-title">
          <h3 id="committee-title">Current Global Network Executive Committee</h3>
          <div class="committee-grid">
            <article class="committee-member">
              <img class="committee-photo" src="{{ asset('assets/dashboard/gn-central/preview-assets') }}/members/steve-obrien.jpg" alt="Portrait of Mr. Steve O'Brien">
              <div class="committee-details">
                <strong><a href="{{ route('dashboard.member-profile.show', ['member' => 'dyslexia-foundation']) }}">Mr. Steve O'Brien</a></strong>
                <span>Chair, IDA Global Network Executive Committee · CEO, Dyslexia Foundation UK</span>
              </div>
            </article>
            <article class="committee-member">
              <img class="committee-photo" src="{{ asset('assets/dashboard/gn-central/preview-assets') }}/members/dr-gad-elbeheri.jpg" alt="Portrait of Dr. Gad Elbeheri">
              <div class="committee-details">
                <strong>Dr. Gad Elbeheri</strong>
                <span>Member, IDA Global Network Executive Committee · IDA Advisor, Special Projects</span>
              </div>
            </article>
            <article class="committee-member">
              <img class="committee-photo" src="{{ asset('assets/dashboard/gn-central/preview-assets') }}/members/dr-eric-tridas.jpg" alt="Portrait of Dr. Eric Tridas">
              <div class="committee-details">
                <strong>Dr. Eric Tridas</strong>
                <span>Member, IDA Global Network Executive Committee</span>
              </div>
            </article>
            <article class="committee-member">
              <img class="committee-photo" src="{{ asset('assets/dashboard/gn-central/preview-assets') }}/members/professor-charles-haynes.jpg" alt="Portrait of Professor Charles Haynes">
              <div class="committee-details">
                <strong>Professor Charles Haynes</strong>
                <span>Member, IDA Global Network Executive Committee</span>
              </div>
            </article>
            <article class="committee-member">
              <img class="committee-photo" src="{{ asset('assets/dashboard/gn-central/preview-assets') }}/members/dr-elsa-cardenas-hagan.jpg" alt="Portrait of Dr. Elsa Cárdenas-Hagan">
              <div class="committee-details">
                <strong>Dr. Elsa Cárdenas-Hagan</strong>
                <span>Member, IDA Global Network Executive Committee</span>
              </div>
            </article>
            <article class="committee-member">
              <img class="committee-photo" src="{{ asset('assets/dashboard/gn-central/preview-assets') }}/members/phyllis-munyi.jpg" alt="Portrait of Phyllis Munyi">
              <div class="committee-details">
                <strong><a href="{{ route('dashboard.member-profile.show', ['member' => 'dyslexia-organization-kenya']) }}">Phyllis Munyi</a></strong>
                <span>Member, IDA Global Network Executive Committee · CEO, Kenya Dyslexia Association</span>
              </div>
            </article>
            <article class="committee-member">
              <img class="committee-photo" src="{{ asset('assets/dashboard/gn-central/preview-assets') }}/members/dr-geetha-shantha-ram.jpeg" alt="Portrait of Dr. Geetha Shantha Ram">
              <div class="committee-details">
                <strong><a href="{{ route('dashboard.member-profile.show', ['member' => 'dyslexia-association-of-singapore']) }}">Dr. Geetha Shantha Ram</a></strong>
                <span>Member, IDA Global Network Executive Committee · Dyslexia Association of Singapore</span>
              </div>
            </article>
            <article class="committee-member">
              <img class="committee-photo" src="{{ asset('assets/dashboard/gn-central/preview-assets') }}/members/lee-siang.jpg" alt="Portrait of Mr. Lee Siang">
              <div class="committee-details">
                <strong><a href="{{ route('dashboard.member-profile.show', ['member' => 'dyslexia-association-of-singapore']) }}">Mr. Lee Siang</a></strong>
                <span>Member, IDA Global Network Executive Committee · CEO, Dyslexia Association of Singapore</span>
              </div>
            </article>
          </div>
        </section>

        <section class="panel" aria-labelledby="friends-title">
          <h3 id="friends-title">At-Large Friends of the Global Network</h3>
          <p class="panel-intro">Individuals who support and follow the Global Network’s international work but are not official member organizations.</p>
          <div class="committee-grid">
            <article class="committee-member friend-card">
              <img class="committee-photo" src="{{ asset('assets/dashboard/gn-central/preview-assets') }}/members/tomohiro-inoue.jpg" alt="Portrait of Tomohiro Inoue">
              <div class="committee-details">
                <strong>Tomohiro Inoue</strong>
                <span>The Chinese University of Hong Kong, Hong Kong</span>
                <span class="friend-label">At-Large Friend</span>
              </div>
            </article>
            <article class="committee-member friend-card">
              <img class="committee-photo" src="{{ asset('assets/dashboard/gn-central/preview-assets') }}/members/juan-luque.jpg" alt="Portrait of Professor Juan Luque">
              <div class="committee-details">
                <strong>Professor Juan Luque</strong>
                <span>Professor, University of Málaga, Spain</span>
                <span class="friend-label">At-Large Friend</span>
              </div>
            </article>
            <article class="committee-member friend-card">
              <img class="committee-photo" src="{{ asset('assets/dashboard/gn-central/preview-assets') }}/members/jeranji-kamfoso.png" alt="Portrait of Jeranji Kamfoso">
              <div class="committee-details">
                <strong>Jeranji Kamfoso</strong>
                <span>Founder &amp; Director, Dyslexia Malawi / Able Foundation, Malawi</span>
                <span class="friend-label">At-Large Friend · Prospective Applicant</span>
              </div>
            </article>
            <article class="committee-member friend-card">
              <img class="committee-photo" src="{{ asset('assets/dashboard/gn-central/preview-assets') }}/members/dr-marlon-ralph-nyakabau.jpeg" alt="Portrait of Dr. Marlon-Ralph Nyakabau">
              <div class="committee-details">
                <strong><a href="{{ route('dashboard.member-profile.show', ['member' => 'marlon-ralph-nyakabau']) }}">Dr. Marlon-Ralph Nyakabau</a></strong>
                <span>Founder and Director, Dyslexia in Africa Trust, Zimbabwe</span>
                <span class="friend-label">At-Large Friend</span>
              </div>
            </article>
            <article class="committee-member friend-card">
              <img class="committee-photo" src="{{ asset('assets/dashboard/gn-central/preview-assets') }}/members/merlaine-yeo.jpg" alt="Portrait of Mrs. Merlaine Yeo">
              <div class="committee-details">
                <strong><a href="{{ route('dashboard.member-profile.show', ['member' => 'unlock-learning-south-africa']) }}">Mrs. Merlaine Yeo</a></strong>
                <span>Director, Unlock Learning, South Africa</span>
                <span class="friend-label">At-Large Friend</span>
              </div>
            </article>
            <article class="committee-member friend-card">
              <img class="committee-photo" src="{{ asset('assets/dashboard/gn-central/preview-assets') }}/members/dr-ahmed-al-shiha.jpeg" alt="Portrait of Dr. Ahmed Al Shiha">
              <div class="committee-details">
                <strong><a href="{{ route('dashboard.member-profile.show', ['member' => 'ahmed-al-shiha']) }}">Dr. Ahmed Al Shiha</a></strong>
                <span>Chairman of the Board, Kuwait Dyslexia Association</span>
                <span class="friend-label">At-Large Friend</span>
              </div>
            </article>
            <article class="committee-member friend-card">
              <img class="committee-photo" src="{{ asset('assets/dashboard/gn-central/preview-assets') }}/members/blessing-ingyape.jpeg" alt="Portrait of Mrs. Blessing Ingyape">
              <div class="committee-details">
                <strong><a href="{{ route('dashboard.member-profile.show', ['member' => 'blessing-ingyape']) }}">Mrs. Blessing Ingyape</a></strong>
                <span>Co-Founder, Dyslexia Project Africa, Nigeria</span>
                <span class="friend-label">At-Large Friend</span>
              </div>
            </article>
          </div>
        </section>

        <section class="panel">
          <h3>Quick Actions</h3>
          <div class="quick-actions">
            <a class="action" href="{{ asset('assets/dashboard/gn-central/GN Application Online Form') }}/prototype/index.html">
              <strong>Start Partner Application</strong>
              <span>Open the Global Network application and begin a new organization submission.</span>
            </a>
            <a class="action" href="{{ route('dashboard.membership-applications.index') }}">
              <strong>Review Applications</strong>
              <span>Open new partner requests, assign reviewers, and track approval decisions.</span>
            </a>
            <a class="action" href="{{ route('dashboard.accreditation-workspace.index') }}">
              <strong>Open Accreditation Workspace</strong>
              <span>Track an accreditation case, review evidence, and record standards-based findings.</span>
            </a>
          </div>
        </section>
      </section>
    </main>
  </div>
  <script>
    const memberLinks = document.querySelectorAll('[data-member-target]');
    const memberPanel = document.getElementById('member-panel');
    const memberGroups = document.querySelectorAll('.member-group');

    memberLinks.forEach((link) => {
      link.addEventListener('click', (event) => {
        event.preventDefault();
        const targetId = link.dataset.memberTarget;

        memberPanel.hidden = false;
        memberLinks.forEach((item) => item.classList.toggle('is-selected', item === link));
        memberGroups.forEach((group) => {
          group.hidden = group.id !== targetId;
        });
        memberPanel.scrollIntoView({ behavior: 'smooth', block: 'start' });
        history.replaceState(null, '', `#${targetId}`);
      });
    });

    function drawApplicationsTrend() {
      const canvas = document.getElementById('applicationsTrendChart');
      if (!canvas) return;

      const ratio = window.devicePixelRatio || 1;
      const width = Math.max(canvas.clientWidth, 280);
      const height = Math.max(canvas.clientHeight, 170);
      canvas.width = Math.round(width * ratio);
      canvas.height = Math.round(height * ratio);

      const context = canvas.getContext('2d');
      context.setTransform(ratio, 0, 0, ratio, 0, 0);
      context.clearRect(0, 0, width, height);

      const values = [5, 7];
      const labels = ['May', 'June'];
      const colors = ['#9bb0c3', '#2367a6'];
      const maxValue = 8;
      const plotLeft = 36;
      const plotRight = width - 14;
      const plotTop = 18;
      const plotBottom = height - 30;
      const plotHeight = plotBottom - plotTop;

      context.font = '10px Inter, system-ui, sans-serif';
      context.textAlign = 'right';
      context.textBaseline = 'middle';
      for (let tick = 0; tick <= maxValue; tick += 2) {
        const y = plotBottom - (tick / maxValue) * plotHeight;
        context.strokeStyle = '#e4eaf0';
        context.lineWidth = 1;
        context.beginPath();
        context.moveTo(plotLeft, y);
        context.lineTo(plotRight, y);
        context.stroke();
        context.fillStyle = '#718096';
        context.fillText(String(tick), plotLeft - 8, y);
      }

      const availableWidth = plotRight - plotLeft;
      const barWidth = Math.min(62, availableWidth / 4);
      values.forEach((value, index) => {
        const centerX = plotLeft + availableWidth * (index === 0 ? 0.3 : 0.7);
        const barHeight = (value / maxValue) * plotHeight;
        const x = centerX - barWidth / 2;
        const y = plotBottom - barHeight;

        context.fillStyle = colors[index];
        context.beginPath();
        context.roundRect(x, y, barWidth, barHeight, 7);
        context.fill();

        context.fillStyle = '#16345b';
        context.font = '700 13px Inter, system-ui, sans-serif';
        context.textAlign = 'center';
        context.fillText(String(value), centerX, y - 10);
        context.fillStyle = '#647286';
        context.font = '11px Inter, system-ui, sans-serif';
        context.fillText(labels[index], centerX, plotBottom + 17);
      });
    }

    drawApplicationsTrend();
    let chartResizeTimer;
    window.addEventListener('resize', () => {
      window.clearTimeout(chartResizeTimer);
      chartResizeTimer = window.setTimeout(drawApplicationsTrend, 120);
    });
  </script>
</body>
</html>
