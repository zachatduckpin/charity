document.addEventListener('DOMContentLoaded',()=>{
  const buttons=[...document.querySelectorAll('[data-tab]')],modules=[...document.querySelectorAll('.module')];
  function openTab(id){buttons.forEach(b=>b.classList.toggle('active',b.dataset.tab===id));modules.forEach(m=>m.classList.toggle('active',m.id===id));history.replaceState(null,'','#'+id)}
  buttons.forEach(b=>b.addEventListener('click',()=>openTab(b.dataset.tab)));
  const initial=location.hash.slice(1);if(initial&&document.getElementById(initial))openTab(initial);
  document.querySelectorAll('form[data-draft]').forEach(form=>{
    const key='gn-central-'+form.dataset.draft;const saved=localStorage.getItem(key);if(saved){try{const data=JSON.parse(saved);Object.entries(data).forEach(([name,value])=>{const field=form.elements[name];if(field&&field.type!=='file'){if(field.type==='checkbox')field.checked=value;else field.value=value}})}catch(e){}}
    form.addEventListener('submit',e=>{e.preventDefault();const data={};new FormData(form).forEach((v,k)=>{if(!(v instanceof File))data[k]=v});form.querySelectorAll('input[type=checkbox]').forEach(f=>data[f.name]=f.checked);localStorage.setItem(key,JSON.stringify(data));showToast(form.dataset.message||'Draft saved securely on this device for review.');});
  });
  document.querySelectorAll('[data-demo]').forEach(b=>b.addEventListener('click',()=>showToast(b.dataset.demo)));
  function showToast(message){const t=document.querySelector('.toast');t.textContent=message;t.classList.add('show');setTimeout(()=>t.classList.remove('show'),3200)}
});
