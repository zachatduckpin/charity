<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>IDA Global Network Central - Applications</title>
  <style>
    :root {
      color-scheme: light;
      --navy: #16345b;
      --blue: #2367a6;
      --teal: #1f9a9c;
      --gold: #d7a642;
      --ink: #182231;
      --muted: #647286;
      --line: #d8e0ea;
      --soft: #f3f7fa;
      --white: #ffffff;
      --success: #287a55;
      --danger: #b54343;
      --warning: #946714;
      font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
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
    }

    .brand {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .brand-logo {
      width: 46px;
      height: 46px;
      border-radius: 8px;
      object-fit: contain;
      background: var(--white);
      padding: 4px;
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

    .nav a {
      color: #d9e5f1;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 11px 12px;
      border-radius: 8px;
      font-size: 14px;
      font-weight: 700;
    }

    .nav a.active,
    .nav a:hover {
      background: rgba(255, 255, 255, 0.12);
      color: #ffffff;
    }

    .nav a.accreditation-main {
      border: 1px solid rgba(31, 154, 156, 0.25);
      background: linear-gradient(135deg, rgba(31, 154, 156, 0.24), rgba(35, 103, 166, 0.12));
      box-shadow: inset 3px 0 0 #d7a642, 0 7px 16px rgba(3, 15, 30, 0.16);
    }

    .sidebar-note {
      margin-top: auto;
      padding: 14px;
      border-radius: 8px;
      background: rgba(255, 255, 255, 0.1);
      color: #c9d8e8;
      font-size: 12px;
      line-height: 1.5;
    }

    .main {
      min-width: 0;
    }

    .topbar {
      min-height: 76px;
      padding: 18px 26px;
      background: var(--white);
      border-bottom: 1px solid var(--line);
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 18px;
    }

    h1,
    h2,
    h3 {
      margin: 0;
      color: var(--navy);
    }

    .topbar p {
      margin: 4px 0 0;
      color: var(--muted);
      font-size: 13px;
    }

    .topbar-actions {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      justify-content: flex-end;
    }

    .start-application {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-height: 42px;
      border-radius: 8px;
      background: linear-gradient(135deg, #1f9a9c 0%, #14777a 100%);
      color: #ffffff;
      padding: 10px 15px;
      font-size: 13px;
      font-weight: 900;
      text-decoration: none;
      box-shadow: 0 8px 20px rgba(31, 154, 156, 0.18);
    }

    .content {
      padding: 24px;
      display: grid;
      gap: 18px;
    }

    .application-links {
      display: grid;
      grid-template-columns: repeat(5, minmax(0, 1fr));
      gap: 12px;
    }

    .type-card {
      border: 0;
      border-radius: 8px;
      padding: 15px;
      color: #ffffff;
      text-align: left;
      cursor: pointer;
      box-shadow: 0 8px 24px rgba(22, 52, 91, 0.12);
    }

    .type-card span {
      display: block;
      font-size: 12px;
      opacity: 0.88;
    }

    .type-card strong {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-top: 8px;
      font-size: 20px;
    }

    .type-card[data-type="new"] {
      background: linear-gradient(135deg, #2367a6 0%, #174d82 100%);
    }

    .type-card[data-type="all"] {
      background: linear-gradient(135deg, #16345b 0%, #102846 100%);
    }

    .type-card[data-type="review"] {
      background: linear-gradient(135deg, #1f9a9c 0%, #14777a 100%);
    }

    .type-card[data-type="decision"] {
      background: linear-gradient(135deg, #d7a642 0%, #aa7b19 100%);
    }

    .type-card[data-type="complete"] {
      background: linear-gradient(135deg, #287a55 0%, #1f6545 100%);
    }

    .type-card.active {
      outline: 3px solid rgba(22, 52, 91, 0.18);
      transform: translateY(-1px);
    }

    .panel {
      border: 1px solid var(--line);
      border-radius: 8px;
      background: var(--white);
      box-shadow: 0 8px 24px rgba(22, 52, 91, 0.05);
    }

    .panel-head {
      padding: 16px 18px;
      border-bottom: 1px solid var(--line);
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 14px;
    }

    .panel-head p {
      margin: 4px 0 0;
      color: var(--muted);
      font-size: 13px;
    }

    .download-selected {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      border: 0;
      border-radius: 8px;
      background: linear-gradient(135deg, #2367a6 0%, #174d82 100%);
      color: #ffffff;
      padding: 10px 14px;
      font-weight: 800;
      cursor: pointer;
    }

    .download-selected span {
      min-width: 22px;
      min-height: 22px;
      border-radius: 999px;
      background: rgba(255, 255, 255, 0.24);
      display: grid;
      place-items: center;
      font-size: 12px;
    }

    .filters {
      padding: 14px 18px;
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      align-items: center;
      border-bottom: 1px solid var(--line);
      background: #fbfdff;
    }

    .filters input,
    .filters select {
      height: 40px;
      border: 1px solid var(--line);
      border-radius: 8px;
      padding: 0 12px;
      color: var(--ink);
      background: #ffffff;
      font: inherit;
      font-size: 13px;
    }

    .filters input[type="search"] {
      min-width: 260px;
      flex: 1 1 260px;
    }

    .filter-button {
      height: 40px;
      border: 0;
      border-radius: 8px;
      padding: 0 14px;
      background: var(--navy);
      color: #ffffff;
      font-weight: 800;
      cursor: pointer;
    }

    .workarea {
      display: grid;
      grid-template-columns: 1fr;
      gap: 18px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 13px;
    }

    th,
    td {
      padding: 13px 14px;
      text-align: left;
      border-bottom: 1px solid #edf1f6;
      vertical-align: middle;
    }

    th {
      color: var(--muted);
      font-size: 11px;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      background: #f7fafc;
    }

    tbody tr:hover {
      background: #fbfdff;
    }

    .name-link {
      color: var(--blue);
      font-weight: 900;
      text-decoration: none;
      border-bottom: 1px solid rgba(35, 103, 166, 0.24);
    }

    .status {
      display: inline-flex;
      align-items: center;
      min-height: 24px;
      padding: 4px 9px;
      border-radius: 999px;
      font-size: 11px;
      font-weight: 900;
      letter-spacing: 0.05em;
      text-transform: uppercase;
    }

    .status.new {
      background: #eaf2fb;
      color: var(--blue);
    }

    .status.review {
      background: #e7f7f5;
      color: #0f6f70;
    }

    .status.decision {
      background: #fff5dc;
      color: var(--warning);
    }

    .status.complete {
      background: #eaf7ef;
      color: var(--success);
    }

    .actions {
      display: flex;
      flex-wrap: wrap;
      gap: 6px;
    }

    .action {
      border: 0;
      border-radius: 7px;
      padding: 7px 9px;
      color: #ffffff;
      font-size: 12px;
      font-weight: 800;
      cursor: pointer;
    }

    .action.view {
      background: var(--blue);
    }

    .action.pdf {
      background: var(--danger);
    }

    .action.comment {
      background: var(--teal);
    }

    .action.decision {
      background: var(--gold);
      color: #432f05;
    }

    @@media (max-width: 1100px) {
      .application-links,
      .workarea {
        grid-template-columns: 1fr;
      }
    }

    @@media (max-width: 880px) {
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

      .topbar,
      .panel-head {
        align-items: flex-start;
        flex-direction: column;
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
      <header class="topbar">
        <div>
          <h1>Applications</h1>
          <p>Review Global Network applications, supporting files, comments, and decisions.</p>
        </div>
        <div class="topbar-actions">
          <a class="start-application" href="{{ asset('assets/dashboard/gn-central/GN Application Online Form') }}/prototype/index.html">Start Application</a>
          <button class="download-selected" type="button">Download Selected <span id="selectedCount">0</span></button>
        </div>
      </header>

      <div class="content">
        <section class="application-links" aria-label="Application status groups">
          <button class="type-card active" type="button" data-type="all"><span>All application records</span><strong>All <em>12</em></strong></button>
          <button class="type-card" type="button" data-type="new"><span>Not yet opened</span><strong>New <em>3</em></strong></button>
          <button class="type-card" type="button" data-type="review"><span>Being checked</span><strong>In Review <em>4</em></strong></button>
          <button class="type-card" type="button" data-type="decision"><span>Ready for decision</span><strong>Decision <em>4</em></strong></button>
          <button class="type-card" type="button" data-type="complete"><span>Decision recorded</span><strong>Complete <em>1</em></strong></button>
        </section>

        <section class="workarea">
          <div class="panel">
            <div class="filters" aria-label="Application filters">
              <input id="searchInput" type="search" placeholder="Search organization, country, or contact">
              <input id="startDate" type="date" aria-label="Start date">
              <input id="endDate" type="date" aria-label="End date">
              <select id="mainFilter" aria-label="Main filter">
                <option value="newest">Newest</option>
                <option value="oldest">Oldest</option>
                <option value="viewed">Viewed</option>
                <option value="not-viewed">Not viewed</option>
                <option value="has-comments">Has comments</option>
                <option value="no-comments">No comments</option>
                <option value="blocked">Blocked</option>
              </select>
              <button class="filter-button" type="button" id="resetFilters">Reset</button>
            </div>

            <table aria-label="Applications table">
              <thead>
                <tr>
                  <th><input id="selectAll" type="checkbox" aria-label="Select all visible applications"></th>
                  <th>Organization</th>
                  <th>Date</th>
                  <th>Country</th>
                  <th>Level</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="applicationsBody"></tbody>
            </table>
          </div>
        </section>
      </div>
    </main>
  </div>

  <script>
    const applications = [
      { id: 1, organization: "Dyslexia Support Network Canada", date: "2026-06-28", country: "Canada", level: "Contributor", contact: "Dr. Helena Ward", status: "new", viewed: false, comments: 0, blocked: false },
      { id: 2, organization: "Literacy Access Initiative", date: "2026-06-24", country: "Jordan", level: "Associate", contact: "Ms. Rana Haddad", status: "review", viewed: true, comments: 2, blocked: false },
      { id: 3, organization: "Reading Differences Alliance", date: "2026-06-21", country: "New Zealand", level: "Partner", contact: "Mr. Liam Baker", status: "decision", viewed: true, comments: 4, blocked: false },
      { id: 4, organization: "Inclusive Learning Foundation", date: "2026-06-18", country: "Malaysia", level: "Associate", contact: "Ms. Aisha Tan", status: "review", viewed: true, comments: 1, blocked: false },
      { id: 5, organization: "Dyslexia Association of Singapore", date: "2026-06-12", country: "Singapore", level: "Partner", contact: "Mr. Lee Siang", status: "complete", viewed: true, comments: 5, blocked: false },
      { id: 6, organization: "Arabic Dyslexia Network", date: "2026-06-08", country: "Egypt", level: "Contributor", contact: "Dr. Salma Nassar", status: "decision", viewed: true, comments: 3, blocked: false },
      { id: 7, organization: "Learning Equity Chile", date: "2026-06-02", country: "Chile", level: "Associate", contact: "Ms. Camila Reyes", status: "new", viewed: false, comments: 0, blocked: false },
      { id: 8, organization: "Dyslexia Outreach Nigeria", date: "2026-05-29", country: "Nigeria", level: "Contributor", contact: "Mr. Ade Okafor", status: "review", viewed: true, comments: 2, blocked: false },
      { id: 9, organization: "Neurodiversity Learning Hub", date: "2026-05-23", country: "Portugal", level: "Associate", contact: "Ms. Sofia Martins", status: "decision", viewed: true, comments: 1, blocked: false },
      { id: 10, organization: "Dyslexia Research & Practice Alliance", date: "2026-05-18", country: "Germany", level: "Partner", contact: "Prof. Erik Vogel", status: "review", viewed: true, comments: 3, blocked: false },
      { id: 11, organization: "School Literacy Partnership", date: "2026-05-14", country: "Kenya", level: "Associate", contact: "Ms. Nia Mwangi", status: "new", viewed: false, comments: 0, blocked: false },
      { id: 12, organization: "Digital Reading Access Group", date: "2026-05-10", country: "Spain", level: "Contributor", contact: "Mr. Mateo Cruz", status: "decision", viewed: true, comments: 4, blocked: true }
    ];

    const tbody = document.getElementById("applicationsBody");
    const selectedCount = document.getElementById("selectedCount");
    const searchInput = document.getElementById("searchInput");
    const mainFilter = document.getElementById("mainFilter");
    const startDate = document.getElementById("startDate");
    const endDate = document.getElementById("endDate");
    const selectAll = document.getElementById("selectAll");
    let currentType = "all";

    const statusLabels = {
      new: "New",
      review: "In Review",
      decision: "Decision",
      complete: "Complete"
    };

    function filteredApplications() {
      const query = searchInput.value.trim().toLowerCase();
      const main = mainFilter.value;
      let rows = applications.filter((application) => {
        const matchesType = currentType === "all" || application.status === currentType;
        const searchable = `${application.organization} ${application.country} ${application.contact} ${application.level}`.toLowerCase();
        const matchesQuery = !query || searchable.includes(query);
        const afterStart = !startDate.value || application.date >= startDate.value;
        const beforeEnd = !endDate.value || application.date <= endDate.value;
        return matchesType && matchesQuery && afterStart && beforeEnd;
      });

      if (main === "viewed") rows = rows.filter((application) => application.viewed);
      if (main === "not-viewed") rows = rows.filter((application) => !application.viewed);
      if (main === "has-comments") rows = rows.filter((application) => application.comments > 0);
      if (main === "no-comments") rows = rows.filter((application) => application.comments === 0);
      if (main === "blocked") rows = rows.filter((application) => application.blocked);

      rows.sort((a, b) => main === "oldest" ? a.date.localeCompare(b.date) : b.date.localeCompare(a.date));
      return rows;
    }

    function renderApplications() {
      tbody.innerHTML = "";
      filteredApplications().forEach((application) => {
        const row = document.createElement("tr");
        row.innerHTML = `
          <td><input class="row-check" type="checkbox" aria-label="Select ${application.organization}"></td>
          <td><a href="#" class="name-link" data-view="${application.id}">${application.organization}</a></td>
          <td>${application.date}</td>
          <td>${application.country}</td>
          <td>${application.level}</td>
          <td><span class="status ${application.status}">${statusLabels[application.status]}</span></td>
          <td>
            <div class="actions">
              <button class="action view" type="button" data-view="${application.id}">View</button>
              <button class="action comment" type="button">Comment ${application.comments ? `(${application.comments})` : ""}</button>
              <button class="action pdf" type="button">PDF</button>
              <button class="action decision" type="button">Decision</button>
            </div>
          </td>
        `;
        tbody.appendChild(row);
      });
      updateSelectedCount();
    }

    function updateSelectedCount() {
      selectedCount.textContent = document.querySelectorAll(".row-check:checked").length;
    }

    document.querySelectorAll(".type-card").forEach((button) => {
      button.addEventListener("click", () => {
        document.querySelectorAll(".type-card").forEach((item) => item.classList.remove("active"));
        button.classList.add("active");
        currentType = button.dataset.type;
        renderApplications();
      });
    });

    [searchInput, mainFilter, startDate, endDate].forEach((control) => {
      control.addEventListener("input", renderApplications);
    });

    document.getElementById("resetFilters").addEventListener("click", () => {
      searchInput.value = "";
      mainFilter.value = "newest";
      startDate.value = "";
      endDate.value = "";
      renderApplications();
    });

    selectAll.addEventListener("change", () => {
      document.querySelectorAll(".row-check").forEach((checkbox) => {
        checkbox.checked = selectAll.checked;
      });
      updateSelectedCount();
    });

    tbody.addEventListener("click", (event) => {
      const viewTarget = event.target.closest("[data-view]");
      if (viewTarget) {
        event.preventDefault();
      }
      if (event.target.classList.contains("row-check")) {
        updateSelectedCount();
      }
    });

    renderApplications();
  </script>
</body>
</html>
