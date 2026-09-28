<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Online Accreditation Application | IDA Global Network Central</title>
  <style>
    :root { color-scheme: light; --navy:#16345b; --deep:#102846; --blue:#2367a6; --teal:#1f9a9c; --gold:#d7a642; --ink:#182231; --muted:#647286; --line:#d8e0ea; --soft:#f3f7fa; --white:#fff; --danger:#b54343; --success:#287a55; font-family:Inter,ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif; }
    * { box-sizing:border-box; }
    body { margin:0; color:var(--ink); background:var(--soft); }
    button,input,select,textarea { font:inherit; }
    .shell { min-height:100vh; display:grid; grid-template-columns:260px minmax(0,1fr); }
    .sidebar { position:sticky; top:0; height:100vh; overflow:auto; padding:22px 18px; display:flex; flex-direction:column; gap:24px; color:#fff; background:linear-gradient(180deg,var(--navy),var(--deep)); }
    .brand { display:flex; align-items:center; gap:12px; }
    .brand img { width:46px; height:46px; object-fit:contain; padding:4px; border-radius:8px; background:#fff; }
    .brand strong { display:block; font-size:15px; }
    .brand span { display:block; margin-top:3px; color:#bfd0e2; font-size:12px; }
    .back { display:flex; align-items:center; gap:8px; padding:10px 11px; border-radius:7px; color:#d9e5f1; text-decoration:none; font-size:13px; }
    .back:hover { color:#fff; background:rgba(255,255,255,.12); }
    .side-title { margin:4px 0 0; color:#f6d98d; font-size:11px; font-weight:850; letter-spacing:.1em; text-transform:uppercase; }
    .steps { display:grid; gap:8px; margin:0; padding:0; list-style:none; }
    .step-link { width:100%; display:grid; grid-template-columns:30px 1fr; align-items:center; gap:10px; padding:9px; border:0; border-radius:8px; color:#c8d7e7; background:transparent; text-align:left; cursor:pointer; }
    .step-link span { width:28px; height:28px; display:grid; place-items:center; border:1px solid rgba(255,255,255,.22); border-radius:50%; font-size:11px; font-weight:800; }
    .step-link strong { font-size:12px; font-weight:700; }
    .step-link.active { color:#fff; background:rgba(255,255,255,.13); }
    .step-link.active span { color:#18324f; border-color:var(--gold); background:var(--gold); }
    .step-link.complete span { color:#fff; border-color:var(--teal); background:var(--teal); }
    .draft-state { margin-top:auto; padding:13px; border:1px solid rgba(255,255,255,.17); border-radius:8px; color:#d7e2ee; background:rgba(255,255,255,.08); font-size:11px; line-height:1.5; }
    .main { min-width:0; }
    .topbar { min-height:72px; display:flex; align-items:center; justify-content:space-between; gap:18px; padding:12px 28px; border-bottom:1px solid var(--line); background:#fff; }
    .topbar h1 { margin:0; font-size:21px; }
    .topbar p { margin:3px 0 0; color:var(--muted); font-size:12px; }
    .save-status { color:var(--success); font-size:12px; font-weight:750; white-space:nowrap; }
    .progress-track { height:5px; background:#dce5ed; }
    .progress-bar { height:100%; width:20%; background:linear-gradient(90deg,var(--teal),var(--blue)); transition:width 220ms ease; }
    .content { max-width:1000px; margin:0 auto; padding:30px; }
    .intro { margin-bottom:20px; padding:20px 22px; border:1px solid #cad9e8; border-radius:13px; background:linear-gradient(90deg,#edf5fb,#fff); }
    .intro strong { display:block; color:var(--navy); font-size:15px; }
    .intro p { margin:6px 0 0; color:var(--muted); font-size:13px; line-height:1.55; }
    .form-step { display:none; }
    .form-step.active { display:block; animation:reveal 180ms ease; }
    @@keyframes reveal { from { opacity:0; transform:translateY(5px); } }
    .section-head { margin-bottom:18px; }
    .section-head span { color:var(--teal); font-size:11px; font-weight:850; letter-spacing:.1em; text-transform:uppercase; }
    .section-head h2 { margin:7px 0 6px; color:var(--navy); font-size:27px; }
    .section-head p { margin:0; color:var(--muted); line-height:1.55; }
    .panel { padding:25px; border:1px solid var(--line); border-radius:15px; background:#fff; box-shadow:0 8px 26px rgba(22,52,91,.06); }
    .grid { display:grid; grid-template-columns:1fr 1fr; gap:18px; }
    .field { display:grid; gap:7px; }
    .field.full { grid-column:1/-1; }
    label,.label { color:#263950; font-size:12px; font-weight:780; }
    .required { color:var(--danger); }
    input[type="text"],input[type="email"],input[type="tel"],input[type="date"],input[type="url"],select,textarea { width:100%; min-height:44px; padding:10px 12px; border:1px solid #cbd6e1; border-radius:8px; color:var(--ink); background:#fff; outline:none; transition:border-color 150ms ease,box-shadow 150ms ease; }
    textarea { min-height:120px; resize:vertical; line-height:1.5; }
    input:focus,select:focus,textarea:focus { border-color:var(--blue); box-shadow:0 0 0 3px rgba(35,103,166,.12); }
    [aria-invalid="true"] { border-color:var(--danger)!important; }
    .hint { color:#7a8798; font-size:11px; line-height:1.4; }
    .counter { text-align:right; color:#7a8798; font-size:10px; }
    .choice-grid { display:grid; grid-template-columns:1fr 1fr; gap:10px; }
    .choice { position:relative; display:flex; align-items:flex-start; gap:10px; min-height:51px; padding:13px; border:1px solid var(--line); border-radius:9px; color:#33465d; background:#fbfcfe; cursor:pointer; font-size:12px; line-height:1.45; }
    .choice input { margin-top:2px; accent-color:var(--blue); }
    .choice:has(input:checked) { border-color:#79a8cf; background:#f0f6fb; }
    .prereqs { display:grid; gap:10px; }
    .prereq { display:grid; grid-template-columns:22px 1fr; gap:11px; align-items:start; padding:13px; border:1px solid var(--line); border-radius:9px; cursor:pointer; }
    .prereq input { width:17px; height:17px; margin:1px 0 0; accent-color:var(--teal); }
    .prereq span { color:#33465d; font-size:12px; line-height:1.5; }
    .note { margin-top:16px; padding:14px 16px; border-left:4px solid var(--gold); border-radius:7px; color:#536276; background:#fff8e7; font-size:12px; line-height:1.55; }
    .actions { display:flex; justify-content:space-between; gap:12px; margin-top:20px; }
    .button { min-height:43px; padding:0 18px; border:0; border-radius:8px; font-size:12px; font-weight:800; cursor:pointer; }
    .button.primary { color:#fff; background:var(--navy); }
    .button.primary:hover { background:#204f7d; }
    .button.secondary { color:var(--navy); border:1px solid #c7d3df; background:#fff; }
    .button.gold { color:#152f4e; background:var(--gold); }
    .button:disabled { opacity:.5; cursor:not-allowed; }
    .error-summary { display:none; margin-bottom:16px; padding:13px 15px; border:1px solid #e1b1b1; border-radius:8px; color:#813333; background:#fff3f3; font-size:12px; }
    .error-summary.show { display:block; }
    .review { display:grid; gap:14px; }
    .review-section { overflow:hidden; border:1px solid var(--line); border-radius:11px; background:#fff; }
    .review-head { display:flex; align-items:center; justify-content:space-between; gap:12px; padding:13px 16px; background:#edf3f8; }
    .review-head h3 { margin:0; color:var(--navy); font-size:14px; }
    .review-head button { border:0; color:var(--blue); background:transparent; font-size:11px; font-weight:800; cursor:pointer; }
    .review-body { display:grid; grid-template-columns:1fr 1fr; gap:13px 20px; padding:16px; }
    .review-item span { display:block; color:var(--muted); font-size:10px; text-transform:uppercase; letter-spacing:.06em; }
    .review-item strong { display:block; margin-top:4px; color:#27394f; font-size:12px; line-height:1.45; white-space:pre-wrap; }
    .certify { margin-top:16px; padding:16px; border:1px solid #c9d9e8; border-radius:10px; background:#f7fafc; }
    .success { display:none; padding:36px; border:1px solid #b7d9c7; border-radius:16px; text-align:center; background:#f2faf6; }
    .success.show { display:block; }
    .success-mark { width:62px; height:62px; display:grid; place-items:center; margin:0 auto 16px; border-radius:50%; color:#fff; background:var(--success); font-size:28px; }
    .success h2 { margin:0; color:var(--navy); }
    .success p { max-width:650px; margin:10px auto 0; color:var(--muted); line-height:1.6; }
    .success-actions { display:flex; flex-wrap:wrap; justify-content:center; gap:10px; margin-top:20px; }
    @@media (max-width:820px) { .shell{grid-template-columns:1fr}.sidebar{position:static;height:auto}.steps{grid-template-columns:repeat(5,1fr)}.step-link{display:block;text-align:center}.step-link strong{display:none}.step-link span{margin:auto}.draft-state,.side-title{display:none} }
    @@media (max-width:620px) { .topbar{padding:14px 18px}.save-status{display:none}.content{padding:18px}.grid,.choice-grid,.review-body{grid-template-columns:1fr}.field.full{grid-column:auto}.panel{padding:19px}.actions{flex-wrap:wrap}.button{flex:1}.intro{padding:17px} }
    @@media print { .sidebar,.topbar,.progress-track,.intro,.actions,.review-head button,.certify{display:none!important}.shell{display:block}.content{max-width:none;padding:0}.form-step{display:none!important}.form-step[data-step="5"]{display:block!important}.panel{border:0;box-shadow:none;padding:0}.review-section{break-inside:avoid}.success{display:none!important} }
  </style>
  <link rel="stylesheet" href="{{ asset('assets/dashboard/gn-central/preview-assets') }}/gn-central-navigation.css">
</head>
<body>
  <div class="shell">
    <aside class="sidebar">
      <div class="brand"><img src="{{ asset('assets/dashboard/gn-central/preview-assets') }}/ida-global-network-logo.png" alt="IDA Global Network logo"><div><strong>Global Network Central</strong><span>Institutional Accreditation</span></div></div>
      <a class="back" href="{{ route('dashboard.accreditation.index') }}">← Back to Accreditation</a>
      <p class="side-title">Application progress</p>
      <ol class="steps">
        <li><button class="step-link active" type="button" data-go="1"><span>1</span><strong>Applicant information</strong></button></li>
        <li><button class="step-link" type="button" data-go="2"><span>2</span><strong>Prerequisites</strong></button></li>
        <li><button class="step-link" type="button" data-go="3"><span>3</span><strong>Institution profile</strong></button></li>
        <li><button class="step-link" type="button" data-go="4"><span>4</span><strong>Accreditation goals</strong></button></li>
        <li><button class="step-link" type="button" data-go="5"><span>5</span><strong>Review & prepare</strong></button></li>
      </ol>
      <div class="draft-state">Your draft is stored only in this browser. Avoid using a shared or public device.</div>
    </aside>

    <main class="main">
      <header class="topbar"><div><h1>Institutional Accreditation Application</h1><p>Based on the official 2024 Initial Application.</p></div><div class="save-status" id="saveStatus">Draft ready</div></header>
      <div class="progress-track"><div class="progress-bar" id="progressBar"></div></div>
      <div class="content">
        <div class="intro"><strong>Before you begin</strong><p>All active IDA Global Network member organizations in good standing are eligible, whether Associate, Contributor or Partner. Required fields are marked with an asterisk. Your answers remain on this device until you prepare the application for submission.</p></div>
        <form id="applicationForm" novalidate>
          <div class="error-summary" id="errorSummary" role="alert">Please complete the highlighted required fields before continuing.</div>

          <section class="form-step active" data-step="1">
            <div class="section-head"><span>Step 1 of 5</span><h2>Applicant information</h2><p>Tell IDA about your institution and the person coordinating accreditation.</p></div>
            <div class="panel"><div class="grid">
              <div class="field full"><label for="institutionName">Name of institution <span class="required">*</span></label><input id="institutionName" name="institutionName" type="text" required autocomplete="organization"></div>
              <div class="field"><label for="contactName">Primary contact person <span class="required">*</span></label><input id="contactName" name="contactName" type="text" required autocomplete="name"></div>
              <div class="field"><label for="contactTitle">Title <span class="required">*</span></label><input id="contactTitle" name="contactTitle" type="text" required autocomplete="organization-title"></div>
              <div class="field"><label for="contactPhone">Contact phone <span class="required">*</span></label><input id="contactPhone" name="contactPhone" type="tel" required autocomplete="tel"></div>
              <div class="field"><label for="contactEmail">Email <span class="required">*</span></label><input id="contactEmail" name="contactEmail" type="email" required autocomplete="email"></div>
              <div class="field full"><label for="website">Organization website <span class="required">*</span></label><input id="website" name="website" type="url" required placeholder="https://" autocomplete="url"></div>
              <div class="field full"><label for="address">Institution’s physical address <span class="required">*</span></label><textarea id="address" name="address" required autocomplete="street-address"></textarea></div>
            </div></div>
            <div class="actions"><span></span><button class="button primary" type="button" data-next>Continue to prerequisites →</button></div>
          </section>

          <section class="form-step" data-step="2">
            <div class="section-head"><span>Step 2 of 5</span><h2>Prerequisite requirements</h2><p>Confirm the preparation activities listed in the official application.</p></div>
            <div class="panel"><div class="prereqs">
              <label class="prereq"><input name="prerequisites" value="Active IDA Global Network membership confirmed" type="checkbox"><span>Confirmed our active IDA Global Network membership and good-standing status.</span></label>
              <label class="prereq"><input name="prerequisites" value="Plan and FAQs reviewed" type="checkbox"><span>Read and understand the IDA Institutional Accreditation Plan and FAQs.</span></label>
              <label class="prereq"><input name="prerequisites" value="Accredited institution contacted" type="checkbox"><span>Contacted an IDA accredited institution regarding the accreditation process.</span></label>
              <label class="prereq"><input name="prerequisites" value="Time and personnel resources budgeted" type="checkbox"><span>Budgeted sufficient time and resources for the primary contact and other personnel.</span></label>
              <label class="prereq"><input name="prerequisites" value="Worked with IDA Mentor" type="checkbox"><span>Worked with an IDA Mentor to guide us through the accreditation process.</span></label>
              <label class="prereq"><input name="prerequisites" value="Self-Study Report completed" type="checkbox"><span>Completed the Self-Study Report.</span></label>
              <label class="prereq"><input name="prerequisites" value="English digital inventory assembled" type="checkbox"><span>Assembled a digital inventory in English supporting each Institutional Accreditation Standard.</span></label>
              <label class="prereq"><input name="prerequisites" value="Funding secured" type="checkbox"><span>Secured funding or adequate resources for the accreditation process.</span></label>
            </div><div class="note">You may continue with incomplete items, but IDA may require all prerequisites before the application can progress.</div></div>
            <div class="actions"><button class="button secondary" type="button" data-prev>← Back</button><button class="button primary" type="button" data-next>Continue to profile →</button></div>
          </section>

          <section class="form-step" data-step="3">
            <div class="section-head"><span>Step 3 of 5</span><h2>Institution profile</h2><p>Provide the organizational information requested in the current application.</p></div>
            <div class="panel"><div class="grid">
              <div class="field full"><span class="label">Legal status <span class="required">*</span></span><div class="choice-grid">
                <label class="choice"><input name="legalStatus" value="Non-Profit, Not-for-Profit or NGO" type="radio" required> Non-Profit, Not-for-Profit, or NGO</label>
                <label class="choice"><input name="legalStatus" value="For-Profit" type="radio"> For-Profit</label>
                <label class="choice"><input name="legalStatus" value="Part of an academic institution" type="radio"> Part of an academic institution</label>
                <label class="choice"><input name="legalStatus" value="Other" type="radio"> Other</label>
              </div></div>
              <div class="field full"><label for="legalStatusOther">If other, specify</label><input id="legalStatusOther" name="legalStatusOther" type="text"></div>
              <div class="field"><label for="fullTimeEmployees">Full-time paid employees <span class="required">*</span></label><select id="fullTimeEmployees" name="fullTimeEmployees" required><option value="">Select range</option><option>&lt; 5</option><option>5-10</option><option>10-50</option><option>&gt; 50</option></select></div>
              <div class="field"><label for="partTimeEmployees">Part-time paid employees <span class="required">*</span></label><select id="partTimeEmployees" name="partTimeEmployees" required><option value="">Select range</option><option>&lt; 5</option><option>5-10</option><option>10-50</option><option>&gt; 50</option></select></div>
              <div class="field"><label for="licensedYears">How long licensed to operate? <span class="required">*</span></label><select id="licensedYears" name="licensedYears" required><option value="">Select range</option><option>&lt; 1 year (Start Up)</option><option>1-5 years</option><option>6-10 years</option><option>&gt; 10 years</option></select></div>
              <div class="field"><span class="label">Accredited by another body? <span class="required">*</span></span><div class="choice-grid"><label class="choice"><input name="otherAccreditation" value="Yes" type="radio" required> Yes</label><label class="choice"><input name="otherAccreditation" value="No" type="radio"> No</label></div></div>
              <div class="field full"><label for="accreditingBodies">If yes, name the accrediting body or bodies</label><textarea id="accreditingBodies" name="accreditingBodies"></textarea></div>
            </div></div>
            <div class="actions"><button class="button secondary" type="button" data-prev>← Back</button><button class="button primary" type="button" data-next>Continue to goals →</button></div>
          </section>

          <section class="form-step" data-step="4">
            <div class="section-head"><span>Step 4 of 5</span><h2>Services and accreditation goals</h2><p>Describe your institution’s work and select why it is seeking IDA accreditation.</p></div>
            <div class="panel"><div class="grid">
              <div class="field full"><label for="serviceActivities">Main service activities <span class="required">*</span></label><textarea id="serviceActivities" name="serviceActivities" maxlength="500" required></textarea><div class="counter"><span id="serviceCount">0</span>/500 characters</div></div>
              <div class="field full"><span class="label">Main reasons for seeking accreditation <span class="required">*</span></span><div class="prereqs" id="reasonGroup">
                <label class="prereq"><input name="reasons" value="International recognition" type="checkbox"><span>Display international recognition of operational integrity and service quality.</span></label>
                <label class="prereq"><input name="reasons" value="Demonstrate quality to clients" type="checkbox"><span>Demonstrate operational integrity and service quality to current or potential clients.</span></label>
                <label class="prereq"><input name="reasons" value="Demonstrate quality to funders" type="checkbox"><span>Demonstrate operational integrity and service quality to current or potential funders.</span></label>
                <label class="prereq"><input name="reasons" value="Meet regulatory requirements" type="checkbox"><span>Meet regulatory requirements.</span></label>
                <label class="prereq"><input name="reasons" value="Other" type="checkbox"><span>Other reason.</span></label>
              </div></div>
              <div class="field full"><label for="otherReason">Other reason, if applicable</label><textarea id="otherReason" name="otherReason"></textarea></div>
            </div></div>
            <div class="actions"><button class="button secondary" type="button" data-prev>← Back</button><button class="button primary" type="button" data-next>Review application →</button></div>
          </section>

          <section class="form-step" data-step="5">
            <div class="section-head"><span>Step 5 of 5</span><h2>Review and prepare submission</h2><p>Check every section before certifying the application.</p></div>
            <div class="review" id="reviewContent"></div>
            <div class="certify"><div class="grid">
              <label class="prereq field full"><input id="certify" name="certify" type="checkbox" required><span>I certify that my answers are true and complete to the best of my knowledge.</span></label>
              <div class="field"><label for="signatureName">Authorized signatory name <span class="required">*</span></label><input id="signatureName" name="signatureName" type="text" required></div>
              <div class="field"><label for="signatureDate">Date <span class="required">*</span></label><input id="signatureDate" name="signatureDate" type="date" required></div>
            </div></div>
            <div class="actions"><button class="button secondary" type="button" data-prev>← Back</button><button class="button gold" type="submit">Prepare submission packet</button></div>
          </section>
        </form>

        <section class="success" id="successPanel">
          <div class="success-mark">✓</div><h2>Your application packet is ready</h2>
          <p>Your reference is <strong id="referenceNumber"></strong>. Download the application record or print it, then email the completed packet to Dana Nwoye at dnwoye@dyslexiaida.org. This preview does not transmit applicant data to a server.</p>
          <div class="success-actions"><button class="button primary" id="downloadRecord" type="button">Download application record</button><button class="button secondary" id="printRecord" type="button">Print application</button><a class="button gold" id="emailApplication" href="mailto:dnwoye@dyslexiaida.org">Email IDA</a></div>
        </section>
      </div>
    </main>
  </div>

  <script>
    const form = document.getElementById('applicationForm');
    const steps = [...document.querySelectorAll('.form-step')];
    const stepLinks = [...document.querySelectorAll('.step-link')];
    const progressBar = document.getElementById('progressBar');
    const saveStatus = document.getElementById('saveStatus');
    const errorSummary = document.getElementById('errorSummary');
    const reviewContent = document.getElementById('reviewContent');
    const storageKey = 'ida-accreditation-application-draft-v1';
    let currentStep = 1;
    let preparedRecord = null;

    function valuesFor(name) { return [...form.querySelectorAll(`[name="${name}"]:checked`)].map(x => x.value); }
    function valueFor(name) { const fields=[...form.querySelectorAll(`[name="${name}"]`)]; const checked=fields.find(x=>x.checked); return checked ? checked.value : (fields[0]?.value || ''); }
    function collectData() {
      const data = {};
      new FormData(form).forEach((value,key) => { if (!['prerequisites','reasons'].includes(key)) data[key]=value; });
      data.prerequisites = valuesFor('prerequisites'); data.reasons = valuesFor('reasons');
      return data;
    }
    function saveDraft() {
      localStorage.setItem(storageKey, JSON.stringify(collectData()));
      saveStatus.textContent = 'Draft saved on this device';
      setTimeout(() => saveStatus.textContent = 'Draft up to date', 1200);
    }
    function restoreDraft() {
      const raw=localStorage.getItem(storageKey); if(!raw) return;
      try { const data=JSON.parse(raw); Object.entries(data).forEach(([name,value]) => {
        const fields=[...form.querySelectorAll(`[name="${name}"]`)];
        fields.forEach(field => { if(['checkbox','radio'].includes(field.type)) field.checked=Array.isArray(value)?value.includes(field.value):field.value===value; else field.value=value||''; });
      }); } catch(e) { localStorage.removeItem(storageKey); }
    }
    function showStep(number) {
      currentStep=number;
      steps.forEach(step=>step.classList.toggle('active',Number(step.dataset.step)===number));
      stepLinks.forEach((link,index)=>{ link.classList.toggle('active',index+1===number); link.classList.toggle('complete',index+1<number); });
      progressBar.style.width=`${number*20}%`; errorSummary.classList.remove('show');
      if(number===5) renderReview(); window.scrollTo({top:0,behavior:'smooth'});
    }
    function validateStep(number) {
      let valid=true; const step=steps.find(x=>Number(x.dataset.step)===number);
      step.querySelectorAll('[required]').forEach(field=>{ const group=field.type==='radio'?[...step.querySelectorAll(`[name="${field.name}"]`)]:[field]; const ok=field.type==='radio'?group.some(x=>x.checked):field.checkValidity(); group.forEach(x=>x.setAttribute('aria-invalid',String(!ok))); if(!ok) valid=false; });
      if(number===4 && valuesFor('reasons').length===0) { valid=false; document.getElementById('reasonGroup').style.outline='2px solid var(--danger)'; } else document.getElementById('reasonGroup').style.outline='';
      errorSummary.classList.toggle('show',!valid); if(!valid) step.querySelector('[aria-invalid="true"]')?.focus(); return valid;
    }
    function esc(value) { const d=document.createElement('div'); d.textContent=value||'Not provided'; return d.innerHTML; }
    function renderReview() {
      const d=collectData();
      const sections=[
        ['Applicant information',1,[['Institution',d.institutionName],['Primary contact',`${d.contactName||''}\n${d.contactTitle||''}`],['Contact',`${d.contactEmail||''}\n${d.contactPhone||''}`],['Website',d.website],['Address',d.address]]],
        ['Prerequisites',2,[['Completed',d.prerequisites.length?d.prerequisites.join('\n• '):'None selected']]],
        ['Institution profile',3,[['Legal status',`${d.legalStatus||''}${d.legalStatusOther?' — '+d.legalStatusOther:''}`],['Employees',`Full-time: ${d.fullTimeEmployees||'—'}\nPart-time: ${d.partTimeEmployees||'—'}`],['Licensed',d.licensedYears],['Other accreditation',`${d.otherAccreditation||''}${d.accreditingBodies?' — '+d.accreditingBodies:''}`]]],
        ['Services and goals',4,[['Main services',d.serviceActivities],['Reasons',d.reasons.length?d.reasons.join('\n• '):'None selected'],['Other reason',d.otherReason]]]
      ];
      reviewContent.innerHTML=sections.map(([title,step,items])=>`<section class="review-section"><div class="review-head"><h3>${title}</h3><button type="button" data-edit="${step}">Edit section</button></div><div class="review-body">${items.map(([label,value])=>`<div class="review-item"><span>${label}</span><strong>${esc(value)}</strong></div>`).join('')}</div></section>`).join('');
    }
    form.addEventListener('input',()=>{ saveDraft(); document.getElementById('serviceCount').textContent=document.getElementById('serviceActivities').value.length; });
    form.addEventListener('change',saveDraft);
    document.addEventListener('click',event=>{
      if(event.target.closest('[data-next]') && validateStep(currentStep)) showStep(Math.min(5,currentStep+1));
      if(event.target.closest('[data-prev]')) showStep(Math.max(1,currentStep-1));
      const go=event.target.closest('[data-go]'); if(go){ const target=Number(go.dataset.go); if(target<=currentStep || validateStep(currentStep)) showStep(target); }
      const edit=event.target.closest('[data-edit]'); if(edit) showStep(Number(edit.dataset.edit));
    });
    form.addEventListener('submit',event=>{
      event.preventDefault(); if(!validateStep(5)) return;
      const now=new Date(); const ref=`IDA-IA-${now.getFullYear()}-${String(now.getTime()).slice(-6)}`;
      preparedRecord={reference:ref,preparedAt:now.toISOString(),application:collectData()};
      document.getElementById('referenceNumber').textContent=ref;
      document.getElementById('emailApplication').href=`mailto:dnwoye@dyslexiaida.org?subject=${encodeURIComponent(`Institutional Accreditation Application — ${preparedRecord.application.institutionName} — ${ref}`)}&body=${encodeURIComponent(`Dear Dana,\n\nPlease find our Institutional Accreditation application for ${preparedRecord.application.institutionName}.\n\nReference: ${ref}\nPrimary contact: ${preparedRecord.application.contactName}\nEmail: ${preparedRecord.application.contactEmail}\n\nThe completed application record will be attached separately.\n\nKind regards`)}`;
      form.style.display='none'; document.querySelector('.intro').style.display='none'; document.getElementById('successPanel').classList.add('show'); localStorage.removeItem(storageKey); window.scrollTo({top:0,behavior:'smooth'});
    });
    document.getElementById('downloadRecord').addEventListener('click',()=>{
      const blob=new Blob([JSON.stringify(preparedRecord,null,2)],{type:'application/json'}); const link=document.createElement('a'); link.href=URL.createObjectURL(blob); link.download=`${preparedRecord.reference}-application.json`; link.click(); URL.revokeObjectURL(link.href);
    });
    document.getElementById('printRecord').addEventListener('click',()=>{ form.style.display='block'; document.getElementById('successPanel').classList.remove('show'); showStep(5); setTimeout(()=>window.print(),100); });
    restoreDraft(); document.getElementById('signatureDate').value ||= new Date().toISOString().slice(0,10); document.getElementById('serviceCount').textContent=document.getElementById('serviceActivities').value.length; showStep(1);
  </script>
</body>
</html>
