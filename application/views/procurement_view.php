<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>เอกสารประกอบการพิจารณาจัดซื้อ-จัดจ้าง อร.</title>

    <link rel="stylesheet" href="<?= base_url('assets/css/menunavigator.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/slidernews.css') ?>">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600&display=swap" rel="stylesheet">

    <script src="<?= base_url('assets/js/jquery-1.6.2.min.js') ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  :root {
    --bg-primary: #ffffff; --bg-secondary: #f7f7f5; --bg-tertiary: #f0efe8;
    --text-primary: #1a1a18; --text-secondary: #6b6b67;
    --border-light: rgba(0,0,0,0.10); --border-mid: rgba(0,0,0,0.18);
    --radius-md: 8px; --radius-lg: 12px;
  }
  body { font-family: 'Sarabun', sans-serif; background: var(--bg-tertiary); color: var(--text-primary); min-height: 100vh; padding: 2rem 1rem 4rem; }
  .pur-wrap { max-width: 820px; margin: 0 auto; background: var(--bg-primary); border-radius: 16px; padding: 2rem 2rem 3rem; border: 0.5px solid var(--border-light); }
  .pur-header { display: flex; align-items: center; gap: 12px; margin-bottom: 2rem; padding-bottom: 1.25rem; border-bottom: 0.5px solid var(--border-light); }
  .pur-icon-wrap { width: 42px; height: 42px; border-radius: 10px; background: #EAF3DE; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
  .pur-icon-wrap i { font-size: 22px; color: #3B6D11; }
  .pur-title { font-size: 18px; font-weight: 600; color: var(--text-primary); }
  .pur-subtitle { font-size: 13px; color: var(--text-secondary); margin-top: 2px; }
  .step-row { display: flex; align-items: center; gap: 8px; margin-bottom: 1.75rem; flex-wrap: wrap; }
  .step-pill { display: inline-flex; align-items: center; gap: 6px; font-size: 12px; font-weight: 500; padding: 4px 12px; border-radius: 20px; border: 0.5px solid var(--border-mid); color: var(--text-secondary); background: var(--bg-secondary); transition: all 0.2s; font-family: 'Sarabun', sans-serif; }
  .step-pill.active { background: #EAF3DE; color: #3B6D11; border-color: #97C459; }
  .step-pill.done { background: #3B6D11; color: #EAF3DE; border-color: #3B6D11; }
  .step-arrow { color: var(--text-secondary); font-size: 13px; }
  .section-label { font-size: 12px; font-weight: 500; color: var(--text-secondary); margin-bottom: 0.75rem; text-transform: uppercase; letter-spacing: 0.06em; font-family: 'Sarabun', sans-serif; }
  .cat-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 10px; margin-bottom: 2rem; }
  .cat-card { padding: 1rem 1.1rem; border-radius: var(--radius-lg); border: 0.5px solid var(--border-light); background: var(--bg-primary); cursor: pointer; transition: all 0.18s; display: flex; flex-direction: column; gap: 8px; }
  .cat-card:hover { border-color: var(--border-mid); background: var(--bg-secondary); transform: translateY(-1px); }
  .cat-card.selected { border: 1.5px solid #3B6D11; background: #EAF3DE; }
  .cat-icon { width: 36px; height: 36px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 18px; }
  .cat-name { font-size: 14px; font-weight: 500; color: var(--text-primary); }
  .cat-count { font-size: 12px; color: var(--text-secondary); }
  .sub-section { display: none; margin-bottom: 2rem; }
  .sub-section.visible { display: block; animation: fadeSlide 0.25s ease; }
  .file-section { display: none; }
  .file-section.visible { display: block; animation: fadeSlide 0.25s ease; }
  @keyframes fadeSlide { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: translateY(0); } }
  .breadcrumb { display: flex; align-items: center; gap: 6px; flex-wrap: wrap; font-size: 13px; color: var(--text-secondary); margin-bottom: 1.25rem; }
  .sub-list { display: flex; flex-direction: column; gap: 6px; }
  .sub-item { display: flex; align-items: center; justify-content: space-between; padding: 0.75rem 1rem; border-radius: var(--radius-md); border: 0.5px solid var(--border-light); background: var(--bg-primary); cursor: pointer; transition: all 0.15s; }
  .sub-item:hover { background: var(--bg-secondary); border-color: var(--border-mid); }
  .sub-item.selected { border: 1.5px solid #3B6D11; background: #EAF3DE; }
  .sub-item-left { display: flex; align-items: center; gap: 10px; }
  .sub-item-left i { font-size: 17px; color: var(--text-secondary); }
  .sub-item.selected .sub-item-left i { color: #3B6D11; }
  .sub-name { font-size: 14px; color: var(--text-primary); }
  .file-section-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem; }
  .file-count-badge { font-size: 12px; padding: 3px 10px; border-radius: 20px; background: #EAF3DE; color: #3B6D11; border: 0.5px solid #97C459; }
  .file-list { display: flex; flex-direction: column; gap: 10px; }
  .item-card { padding: 1rem 1.1rem; border-radius: var(--radius-md); border: 0.5px solid var(--border-light); background: var(--bg-primary); }
  .item-header { display: flex; align-items: center; justify-content: space-between; gap: 10px; margin-bottom: 0.5rem; }
  .item-title { font-size: 14px; font-weight: 600; color: var(--text-primary); }
  .item-meta { font-size: 11px; color: var(--text-secondary); }
  .item-content { font-size: 14px; line-height: 1.7; color: var(--text-primary); white-space: pre-wrap; word-break: break-word; background: var(--bg-secondary); border-radius: var(--radius-md); padding: 0.75rem 0.9rem; }
  .item-content:empty::before { content: 'ยังไม่มีข้อความ'; color: var(--text-secondary); }
  .btn-copy { display: inline-flex; align-items: center; gap: 5px; font-size: 12px; padding: 4px 10px; border-radius: var(--radius-md); border: 0.5px solid var(--border-mid); background: transparent; color: var(--text-primary); cursor: pointer; font-family: 'Sarabun', sans-serif; white-space: nowrap; transition: all 0.15s; }
  .btn-copy:hover { background: var(--bg-secondary); }
  @media (max-width: 500px) { .pur-wrap { padding: 1.25rem 1rem 2rem; } .cat-grid { grid-template-columns: repeat(2, 1fr); } }
</style>
</head>
<body>

<div class="pur-wrap">

  <div class="pur-header">
    <div class="pur-icon-wrap"><i class="ti ti-building-store"></i></div>
    <div>
      <div class="pur-title">ระบบเอกสารจัดซื้อ - จัดจ้าง</div>
      <div class="pur-subtitle">เลือกประเภทงานเพื่อค้นหาเอกสารที่ต้องการ</div>
    </div>
  </div>

  <div class="step-row">
    <div class="step-pill active" id="step1-pill"><i class="ti ti-list-check"></i> ขั้นที่ 1: ประเภทงาน</div>
    <div class="step-arrow">›</div>
    <div class="step-pill" id="step2-pill"><i class="ti ti-folder-open"></i> ขั้นที่ 2: หัวข้อย่อย</div>
    <div class="step-arrow">›</div>
    <div class="step-pill" id="step3-pill"><i class="ti ti-folder"></i> ขั้นที่ 3: หัวข้อย่อย</div>
    <div class="step-arrow">›</div>
    <div class="step-pill" id="step4-pill"><i class="ti ti-files"></i> ขั้นที่ 4: รายการเอกสาร</div>
  </div>

  <div class="section-label">เลือกประเภทงานเอกสารจัดซื้อ</div>
  <div class="cat-grid" id="catGrid"></div>

  <div class="sub-section" id="sec1">
    <div class="breadcrumb" id="bc1"></div>
    <div class="section-label">หัวข้อย่อยระดับ 1</div>
    <div class="sub-list" id="list1"></div>
  </div>

  <div class="sub-section" id="sec2">
    <div class="breadcrumb" id="bc2"></div>
    <div class="section-label">หัวข้อย่อยระดับ 2</div>
    <div class="sub-list" id="list2"></div>
  </div>

  <div class="file-section" id="fileSection">
    <div class="breadcrumb" id="bcFile"></div>
    <div class="file-section-header">
      <div class="section-label" style="margin-bottom:0">รายการเอกสาร</div>
      <div class="file-count-badge" id="fileCountBadge"></div>
    </div>
    <div class="file-list" id="fileList"></div>
  </div>

</div>

<script>
let data = {}, sel = [null, null, null];
const DOWNLOAD_BASE = '<?= base_url('procurement/download') ?>';

function countItems(cat) {
  let n = 0;
  Object.values(data[cat].subs).forEach(l1 => Object.values(l1).forEach(items => n += items.length));
  return n;
}
function makeBreadcrumb(parts) { return parts.filter(Boolean).join(' › '); }

function renderCats() {
  const g = document.getElementById('catGrid');
  g.innerHTML = '';
  if (Object.keys(data).length === 0) {
    g.innerHTML = '<div style="grid-column:1/-1;text-align:center;color:#aaa;padding:2rem 0">ยังไม่มีข้อมูล</div>';
    return;
  }
  Object.entries(data).forEach(([name, d]) => {
    const c = document.createElement('div');
    c.className = 'cat-card' + (sel[0] === name ? ' selected' : '');
    c.innerHTML = `
      <div class="cat-icon" style="background:${d.color}">
        <i class="ti ${d.icon}" style="color:${d.iconColor}"></i>
      </div>
      <div class="cat-name">${name}</div>
      <div class="cat-count">${countItems(name)} รายการ</div>`;
    c.onclick = () => selectCat(name);
    g.appendChild(c);
  });
}

function renderSubList(listId, items, selectedName, onSelect) {
  const sl = document.getElementById(listId);
  sl.innerHTML = '';
  Object.keys(items).forEach(name => {
    const el = document.createElement('div');
    el.className = 'sub-item' + (selectedName === name ? ' selected' : '');
    el.innerHTML = `
      <div class="sub-item-left">
        <i class="ti ti-folder"></i>
        <span class="sub-name">${name}</span>
      </div>`;
    el.onclick = () => onSelect(name);
    sl.appendChild(el);
  });
}

function selectCat(name) {
  sel = [name, null, null];
  renderCats();
  setPills(1);
  document.getElementById('bc1').textContent = name + ' › เลือกหัวข้อย่อย';
  renderSubList('list1', data[name].subs, null, selectL1);
  show('sec1'); hide('sec2'); hide('fileSection');
}

function selectL1(name) {
  sel[1] = name; sel[2] = null;
  renderSubList('list1', data[sel[0]].subs, name, selectL1);
  setPills(2);
  document.getElementById('bc2').textContent = makeBreadcrumb([sel[0], name]) + ' › เลือกหัวข้อย่อย';
  renderSubList('list2', data[sel[0]].subs[name], null, selectL2);
  show('sec2'); hide('fileSection');
}

function selectL2(name) {
  sel[2] = name;
  renderSubList('list2', data[sel[0]].subs[sel[1]], name, selectL2);
  setPills(3);
  const items = data[sel[0]].subs[sel[1]][name];
  document.getElementById('bcFile').textContent = makeBreadcrumb([sel[0], sel[1], name]);
  renderItems(items);
  show('fileSection');
}

function setPills(active) {
  for (let i = 1; i <= 4; i++) {
    const p = document.getElementById('step' + i + '-pill');
    p.className = i < active + 1 ? (i === active ? 'step-pill active' : 'step-pill done') : 'step-pill';
  }
}
function show(id) { document.getElementById(id).className = (id === 'fileSection' ? 'file-section' : 'sub-section') + ' visible'; }
function hide(id) { document.getElementById(id).className = id === 'fileSection' ? 'file-section' : 'sub-section'; }

function renderItems(items) {
  document.getElementById('fileCountBadge').textContent = `${items.length} รายการ`;
  const fl = document.getElementById('fileList');
  fl.innerHTML = '';
  items.forEach(it => {
    const el = document.createElement('div');
    el.className = 'item-card';
    const meta = it.updated_at ? `อัปเดต ${it.updated_at}` : '';
    el.innerHTML = `
      <div class="item-header">
        <div class="item-title">${escapeHtml(it.title)}</div>
        <div style="display:flex;gap:6px;flex-shrink:0">
          <button class="btn-copy" type="button"><i class="ti ti-copy"></i><span>คัดลอก</span></button>
          ${it.id ? `<a class="btn-copy" href="${DOWNLOAD_BASE}/${it.id}"><i class="ti ti-file-type-doc"></i><span>Word</span></a>` : ''}
        </div>
      </div>
      <div class="item-content">${escapeHtml(it.content || '')}</div>
      ${meta ? `<div class="item-meta" style="margin-top:6px">${meta}</div>` : ''}
    `;
    el.querySelector('.btn-copy').onclick = (e) => {
      e.stopPropagation();
      navigator.clipboard.writeText(it.content || '').then(() => {
        const span = e.currentTarget.querySelector('span');
        const old = span.textContent;
        span.textContent = 'คัดลอกแล้ว';
        setTimeout(() => { span.textContent = old; }, 1200);
      });
    };
    fl.appendChild(el);
  });
}
function escapeHtml(str) {
  const div = document.createElement('div');
  div.textContent = str;
  return div.innerHTML;
}

fetch('<?= base_url('procurement/data') ?>')
  .then(r => r.json())
  .then(d => { data = d; renderCats(); })
  .catch(() => {
    document.getElementById('catGrid').innerHTML = '<div style="grid-column:1/-1;text-align:center;color:#c00;padding:1.5rem 0">โหลดข้อมูลไม่สำเร็จ</div>';
  });
</script>
</body>
</html>
