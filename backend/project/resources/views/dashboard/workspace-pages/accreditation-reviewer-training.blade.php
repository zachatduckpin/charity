<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reviewer Training | IDA Global Network Central</title>
  <style>
    :root { color-scheme:light; --navy:#16345b; --deep:#102846; --blue:#2367a6; --teal:#1f9a9c; --gold:#d7a642; --ink:#182231; --muted:#647286; --line:#d8e0ea; --soft:#f3f7fa; --white:#fff; font-family:Inter,ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif; }
    * { box-sizing:border-box; }
    body { margin:0; color:var(--ink); background:var(--soft); }
    button { font:inherit; }
    .shell { min-height:100vh; display:grid; grid-template-columns:260px minmax(0,1fr); }
    .sidebar { position:sticky; top:0; height:100vh; overflow:auto; display:flex; flex-direction:column; gap:24px; padding:22px 18px; color:#fff; background:linear-gradient(180deg,var(--navy),var(--deep)); }
    .brand { display:flex; align-items:center; gap:12px; }
    .brand img { width:46px; height:46px; object-fit:contain; padding:4px; border-radius:8px; background:#fff; }
    .brand strong { display:block; font-size:15px; }
    .brand span { display:block; margin-top:3px; color:#bfd0e2; font-size:12px; }
    .nav { display:grid; gap:6px; }
    .nav>a,.nav-group>summary { display:flex; align-items:center; padding:10px 11px; border-radius:6px; color:#d9e5f1; font-size:14px; text-decoration:none; }
    .nav>a:hover,.nav-group>summary:hover,.nav-group[open]>summary { color:#fff; background:rgba(255,255,255,.14); box-shadow:inset 3px 0 0 var(--gold); }
    .nav-group summary { list-style:none; cursor:pointer; }
    .nav-group summary::-webkit-details-marker { display:none; }
    .nav-group>summary::after { content:"›"; margin-left:auto; transition:transform 160ms ease; }
    .nav-group[open]>summary::after { transform:rotate(90deg); color:var(--gold); }
    .nav-group>summary { border:1px solid rgba(31,154,156,.30); background:linear-gradient(135deg,rgba(31,154,156,.28),rgba(35,103,166,.13)); backdrop-filter:blur(12px); box-shadow:0 7px 17px rgba(3,15,30,.16),inset 0 1px 0 rgba(255,255,255,.08); transition:transform 140ms ease,background 180ms ease,box-shadow 180ms ease; }
    .nav-group[open]>summary { background:linear-gradient(135deg,rgba(31,154,156,.52),rgba(35,103,166,.26)); box-shadow:inset 3px 0 0 var(--gold),0 9px 21px rgba(3,15,30,.22); }
    .nav-group>summary:active { transform:translateY(2px) scale(.985); box-shadow:inset 0 3px 8px rgba(0,0,0,.24); }
    .nav-sub { display:grid; gap:7px; margin:5px 0 8px 27px; }
    .nav-sub a { padding:7px 9px; border-radius:6px; color:#c7d7e8; background:rgba(255,255,255,.06); text-decoration:none; font-size:12px; }
    .nav-sub a:hover,.nav-sub a.active { color:#fff; background:rgba(255,255,255,.13); }
    .sidebar-note { margin-top:auto; padding:14px; border:1px solid rgba(255,255,255,.18); border-radius:8px; color:#d7e2ee; background:rgba(255,255,255,.09); font-size:12px; line-height:1.5; }
    .main { min-width:0; }
    .topbar { min-height:72px; display:flex; align-items:center; justify-content:space-between; gap:16px; padding:13px 28px; border-bottom:1px solid var(--line); background:#fff; }
    .topbar h1 { margin:0; font-size:21px; }
    .topbar p { margin:3px 0 0; color:var(--muted); font-size:13px; }
    .deck-link { padding:9px 13px; border:1px solid #c9d5e1; border-radius:7px; color:var(--navy); background:#fff; text-decoration:none; font-size:12px; font-weight:800; }
    .content { max-width:1320px; margin:0 auto; padding:27px; }
    .intro { display:grid; grid-template-columns:minmax(0,1fr) auto; align-items:end; gap:20px; margin-bottom:18px; }
    .eyebrow { margin:0 0 7px; color:var(--teal); font-size:11px; font-weight:850; letter-spacing:.1em; text-transform:uppercase; }
    .intro h2 { margin:0; color:var(--navy); font-size:29px; }
    .intro p:last-child { max-width:780px; margin:8px 0 0; color:var(--muted); line-height:1.55; }
    .progress { min-width:150px; text-align:right; }
    .progress strong { display:block; color:var(--navy); font-size:18px; }
    .progress span { color:var(--muted); font-size:11px; }
    .learning-shell { display:grid; grid-template-columns:minmax(0,1fr) 285px; gap:18px; align-items:start; }
    .viewer { overflow:hidden; border:1px solid var(--line); border-radius:16px; background:#fff; box-shadow:0 13px 36px rgba(22,52,91,.10); }
    .stage { position:relative; display:grid; place-items:center; min-height:450px; padding:22px; background:#0e2138; }
    .stage img { display:block; width:100%; max-height:70vh; object-fit:contain; box-shadow:0 10px 30px rgba(0,0,0,.24); }
    .stage button { position:absolute; top:50%; width:40px; height:52px; border:1px solid rgba(255,255,255,.25); border-radius:8px; color:#fff; background:rgba(6,19,34,.72); cursor:pointer; transform:translateY(-50%); }
    .stage button:hover { background:var(--blue); }
    .previous { left:10px; }.next { right:10px; }
    .viewer-footer { display:flex; align-items:center; justify-content:space-between; gap:15px; padding:15px 18px; }
    .slide-meta strong { display:block; color:var(--navy); font-size:14px; }
    .slide-meta span { display:block; margin-top:3px; color:var(--muted); font-size:11px; }
    .footer-actions { display:flex; gap:8px; }
    .footer-actions button { min-height:36px; padding:0 12px; border:1px solid #cbd6e1; border-radius:7px; color:var(--navy); background:#fff; font-size:11px; font-weight:800; cursor:pointer; }
    .outline { overflow:hidden; border:1px solid var(--line); border-radius:14px; background:#fff; }
    .outline-head { padding:17px; border-bottom:1px solid var(--line); background:#eef4f8; }
    .outline-head h3 { margin:0; color:var(--navy); font-size:15px; }
    .outline-head p { margin:4px 0 0; color:var(--muted); font-size:11px; }
    .chapters { display:grid; max-height:610px; overflow:auto; padding:8px; }
    .chapter { display:grid; grid-template-columns:42px 1fr; gap:10px; align-items:center; width:100%; padding:9px; border:0; border-radius:8px; color:var(--ink); background:transparent; text-align:left; cursor:pointer; }
    .chapter:hover,.chapter.active { background:#eef5fa; }
    .thumb { width:42px; aspect-ratio:16/9; object-fit:cover; border:1px solid #cbd6e1; background:var(--navy); }
    .chapter strong { display:block; color:var(--navy); font-size:11px; line-height:1.3; }
    .chapter span { display:block; margin-top:2px; color:var(--muted); font-size:9px; }
    .takeaway { margin-top:18px; display:grid; grid-template-columns:auto 1fr; gap:14px; align-items:start; padding:19px; border-left:5px solid var(--gold); border-radius:10px; background:#fff8e8; }
    .takeaway-mark { width:37px; height:37px; display:grid; place-items:center; border-radius:10px; color:#17314f; background:var(--gold); font-weight:900; }
    .takeaway h3 { margin:0; color:var(--navy); font-size:15px; }
    .takeaway p { margin:5px 0 0; color:#5e6876; font-size:12px; line-height:1.55; }
    @@media(max-width:980px){.shell{grid-template-columns:1fr}.sidebar{position:static;height:auto}.nav{grid-template-columns:repeat(3,minmax(0,1fr))}.nav-sub,.sidebar-note{display:none}.learning-shell{grid-template-columns:1fr}.chapters{grid-template-columns:repeat(3,1fr);max-height:none}}
    @@media(max-width:650px){.topbar{padding:14px 18px}.deck-link{display:none}.content{padding:18px}.intro{grid-template-columns:1fr}.progress{text-align:left}.stage{min-height:240px;padding:10px}.stage button{width:34px;height:44px}.chapters{grid-template-columns:1fr 1fr}.viewer-footer{align-items:flex-start;flex-direction:column}}
  </style>
  <link rel="stylesheet" href="{{ asset('assets/dashboard/gn-central/preview-assets') }}/gn-central-navigation.css">
</head>
<body>
  <div class="shell">
    <aside class="sidebar">
      <div class="brand"><img src="{{ asset('assets/dashboard/gn-central/preview-assets') }}/ida-global-network-logo.png" alt="IDA Global Network logo"><div><strong>Global Network Central</strong><span>Reviewer Learning</span></div></div>
      <nav class="nav">
        <a data-icon="⌂" href="{{ route('dashboard.index') }}">Home</a>
        <a data-icon="▤" href="{{ route('dashboard.membership-applications.index') }}">Applications</a>
        <a data-icon="♛" data-section="leadership" href="{{ route('dashboard.member-leadership.index') }}">Member Leadership</a>
        <a data-icon="◫" href="{{ route('dashboard.member-operations.index') }}">Member Operations</a>
        <a data-icon="▥" data-section="resources" href="{{ route('dashboard.membership-options.index') }}">Resources</a>
        <details class="nav-group current-section" data-section="accreditation" open><summary data-icon="✪">Institutional Accreditation</summary><div class="nav-sub">
          <a href="{{ route('dashboard.accreditation.index') }}">Overview</a>
          <a href="{{ route('dashboard.accreditation.index') }}#readiness">Applicant readiness</a>
          <a href="{{ route('dashboard.accreditation-application.index') }}">Apply online</a>
          <a href="{{ route('dashboard.accreditation-workspace.index') }}">Process workspace</a>
          <a class="active" href="#">Reviewer training</a>
        </div></details>
        <a data-icon="✉" href="{{ route('dashboard.resource-centre.index') }}">Communications</a><a data-icon="▦" href="#">Reports</a><a data-icon="⚙" href="{{ route('dashboard.authority-levels.index') }}">Authority &amp; Profiles</a>
      </nav>
      <div class="sidebar-note">For consultants and reviewers assigned to evaluate, guide, and oversee Institutional Accreditation.</div>
    </aside>

    <main class="main">
      <header class="topbar"><div><h1>Institutional Accreditation Reviewer Training</h1><p>Interactive learning reader · 2025 edition</p></div><a class="deck-link" href="{{ asset('assets/dashboard/gn-central/GN Central') }}/Institutional Accreditation/Global Network Institutional Accreditation Reviewer Training_2025.pptx">Download PowerPoint</a></header>
      <div class="content">
        <section class="intro"><div><p class="eyebrow">Consultant learning center</p><h2>Review with confidence and consistency.</h2><p>Work through the training deck at your own pace. Use the chapter outline to revisit standards, site-review procedures, common challenges, and professional ethics.</p></div><div class="progress"><strong id="progressText">Slide 1 of 9</strong><span>Your position is saved on this device</span></div></section>

        <div class="learning-shell">
          <section class="viewer" aria-label="Training slide viewer">
            <div class="stage"><button class="previous" id="previousSlide" type="button" aria-label="Previous slide">‹</button><img id="currentSlide" src="{{ asset('assets/dashboard/gn-central/GN Central') }}/Institutional Accreditation/Global Network Institutional Accreditation Reviewer Training_2025/slide-1.png" alt="Reviewer training slide 1"><button class="next" id="nextSlide" type="button" aria-label="Next slide">›</button></div>
            <div class="viewer-footer"><div class="slide-meta"><strong id="slideTitle">Institutional Accreditation Reviewer Training</strong><span id="slideSection">Introduction</span></div><div class="footer-actions"><button id="restart" type="button">Restart</button><button id="markComplete" type="button">Mark complete</button></div></div>
          </section>

          <aside class="outline" aria-label="Training chapters"><div class="outline-head"><h3>Training outline</h3><p>Select a slide to continue learning.</p></div><div class="chapters" id="chapters"></div></aside>
        </div>

        <section class="takeaway"><div class="takeaway-mark">✓</div><div><h3>Reviewer responsibility</h3><p>Apply the standards objectively, communicate findings clearly, maintain confidentiality, avoid conflicts of interest, and provide actionable feedback that supports institutional development.</p></div></section>
      </div>
    </main>
  </div>

  <script>
    const base='{{ asset('assets/dashboard/gn-central/GN Central') }}/Institutional Accreditation/Global Network Institutional Accreditation Reviewer Training_2025';
    const slides=[
      ['Institutional Accreditation Reviewer Training','Introduction'],
      ['Training Objectives','Learning goals'],
      ['Purpose of Institutional Accreditation','Accreditation foundations'],
      ['Accreditation Levels','Accreditation framework'],
      ['Key Quality Standards','Evaluation standards'],
      ['Site Reviewer Procedures','Review practice'],
      ['Common Challenges and Solutions','Problem solving'],
      ['Reviewer Ethics and Best Practices','Professional conduct'],
      ['Conclusion and Next Steps','Continuing development']
    ];
    const image=document.getElementById('currentSlide');
    const title=document.getElementById('slideTitle');
    const section=document.getElementById('slideSection');
    const progress=document.getElementById('progressText');
    const chapters=document.getElementById('chapters');
    let current=Math.min(Number(localStorage.getItem('ida-reviewer-training-slide')||0),slides.length-1);

    slides.forEach((slide,index)=>{
      const button=document.createElement('button'); button.className='chapter'; button.type='button'; button.dataset.slide=index;
      button.innerHTML=`<img class="thumb" src="${base}/slide-${index+1}.png" alt=""><span><strong>${slide[0]}</strong><span>Slide ${index+1}</span></span>`;
      chapters.appendChild(button);
    });
    function showSlide(index){
      current=(index+slides.length)%slides.length; image.src=`${base}/slide-${current+1}.png`; image.alt=`Reviewer training slide ${current+1}: ${slides[current][0]}`;
      title.textContent=slides[current][0]; section.textContent=slides[current][1]; progress.textContent=`Slide ${current+1} of ${slides.length}`;
      [...document.querySelectorAll('.chapter')].forEach((button,i)=>button.classList.toggle('active',i===current));
      localStorage.setItem('ida-reviewer-training-slide',String(current));
    }
    document.getElementById('previousSlide').addEventListener('click',()=>showSlide(current-1));
    document.getElementById('nextSlide').addEventListener('click',()=>showSlide(current+1));
    document.getElementById('restart').addEventListener('click',()=>showSlide(0));
    document.getElementById('markComplete').addEventListener('click',event=>{ localStorage.setItem('ida-reviewer-training-complete','true'); event.target.textContent='Training completed ✓'; });
    chapters.addEventListener('click',event=>{ const button=event.target.closest('[data-slide]'); if(button) showSlide(Number(button.dataset.slide)); });
    document.addEventListener('keydown',event=>{ if(event.key==='ArrowLeft') showSlide(current-1); if(event.key==='ArrowRight') showSlide(current+1); });
    if(localStorage.getItem('ida-reviewer-training-complete')==='true') document.getElementById('markComplete').textContent='Training completed ✓';
    showSlide(current);
  </script>
</body>
</html>
