<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

<div class="bg-white rounded-xl shadow-sm p-6 mb-6">
  <h2 class="font-semibold text-gray-700 mb-1">เพิ่มหมวดหมู่ใหม่</h2>
  <p class="text-xs text-gray-400 mb-3">เช่น "ร่าง TOR", "พรบ./ระเบียบ/มติ ครม."</p>
  <form id="catForm" class="flex flex-wrap gap-2">
    <input name="name" placeholder="ชื่อหมวดหมู่" required
           class="border border-gray-200 rounded-lg px-3 py-2 text-sm flex-1 min-w-[220px]">
    <input name="icon" placeholder="ไอคอน Tabler เช่น ti-shopping-cart"
           class="border border-gray-200 rounded-lg px-3 py-2 text-sm w-64">
    <button class="bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors">
      <i class="fa-solid fa-plus mr-1"></i> เพิ่ม
    </button>
  </form>
</div>

<div id="tree" class="space-y-4"></div>

<script>
const API = {
  tree:     '<?= base_url('procurement_admin/tree') ?>',
  catSave:  '<?= base_url('procurement_admin/category_save') ?>',
  catDel:   '<?= base_url('procurement_admin/category_delete') ?>',
  sub1Save: '<?= base_url('procurement_admin/sub1_save') ?>',
  sub1Del:  '<?= base_url('procurement_admin/sub1_delete') ?>',
  sub2Save: '<?= base_url('procurement_admin/sub2_save') ?>',
  sub2Del:  '<?= base_url('procurement_admin/sub2_delete') ?>',
  itemSave:    '<?= base_url('procurement_admin/item_save') ?>',
  itemDel:     '<?= base_url('procurement_admin/item_delete') ?>',
  itemHistory: '<?= base_url('procurement_admin/item_history') ?>',
};

async function postForm(url, fields) {
  const fd = new FormData();
  Object.entries(fields).forEach(([k, v]) => fd.append(k, v ?? ''));
  const res = await fetch(url, { method: 'POST', body: fd });
  return res.json();
}
async function postDelete(url) {
  return fetch(url, { method: 'POST' }).then(r => r.json());
}

async function loadTree() {
  const res = await fetch(API.tree);
  const json = await res.json();
  renderTree(json.data || []);
}

function el(tag, cls, html) {
  const e = document.createElement(tag);
  if (cls) e.className = cls;
  if (html !== undefined) e.innerHTML = html;
  return e;
}

function renderTree(categories) {
  const root = document.getElementById('tree');
  root.innerHTML = '';

  if (categories.length === 0) {
    root.innerHTML = '<div class="text-center text-gray-400 text-sm py-8 bg-white rounded-xl shadow-sm">ยังไม่มีหมวดหมู่ เริ่มเพิ่มด้านบนได้เลย</div>';
    return;
  }

  categories.forEach(cat => {
    const catCard = el('div', 'bg-white rounded-xl shadow-sm p-5');
    catCard.innerHTML = `
      <div class="flex items-center justify-between mb-3">
        <div class="font-semibold text-gray-700 flex items-center gap-2">
          <i class="ti ${cat.icon || 'ti-folder'} text-indigo-500"></i> ${cat.name}
        </div>
        <button class="text-xs text-red-500 hover:text-red-700" data-del-cat="${cat.id}">
          <i class="fa-solid fa-trash mr-1"></i>ลบหมวดหมู่
        </button>
      </div>
      <div class="pl-4 border-l-2 border-gray-100 space-y-3" data-sub1-container="${cat.id}"></div>
      <form class="flex gap-2 mt-3" data-add-sub1="${cat.id}">
        <input name="name" placeholder="+ เพิ่มหัวข้อย่อยระดับ 1" required
               class="border border-gray-200 rounded-lg px-2 py-1.5 text-sm flex-1">
        <button class="text-sm text-indigo-600 font-medium">เพิ่ม</button>
      </form>
    `;
    root.appendChild(catCard);

    const sub1Container = catCard.querySelector(`[data-sub1-container="${cat.id}"]`);
    (cat.sub1 || []).forEach(s1 => {
      const s1Box = el('div', 'bg-gray-50 rounded-lg p-3');
      s1Box.innerHTML = `
        <div class="flex items-center justify-between mb-2">
          <div class="text-sm font-medium text-gray-700">${s1.name}</div>
          <button class="text-xs text-red-500 hover:text-red-700" data-del-sub1="${s1.id}">ลบ</button>
        </div>
        <div class="pl-4 border-l-2 border-gray-200 space-y-3" data-sub2-container="${s1.id}"></div>
        <form class="flex gap-2 mt-2" data-add-sub2="${s1.id}">
          <input name="name" placeholder="+ เพิ่มหัวข้อย่อยระดับ 2" required
                 class="border border-gray-200 rounded-lg px-2 py-1 text-xs flex-1">
          <button class="text-xs text-indigo-600 font-medium">เพิ่ม</button>
        </form>
      `;
      sub1Container.appendChild(s1Box);

      const sub2Container = s1Box.querySelector(`[data-sub2-container="${s1.id}"]`);
      (s1.sub2 || []).forEach(s2 => {
        const s2Box = el('div', 'bg-white border border-gray-200 rounded-lg p-3');
        s2Box.innerHTML = `
          <div class="flex items-center justify-between mb-2">
            <div class="text-xs font-medium text-gray-500">${s2.name}</div>
            <button class="text-xs text-red-500 hover:text-red-700" data-del-sub2="${s2.id}">ลบ</button>
          </div>
          <div class="space-y-2" data-items-container="${s2.id}"></div>
          <button class="text-xs text-indigo-600 font-medium mt-2" data-add-item="${s2.id}">
            <i class="fa-solid fa-plus mr-1"></i>เพิ่มรายการเอกสาร
          </button>
        `;
        sub2Container.appendChild(s2Box);

        const itemsContainer = s2Box.querySelector(`[data-items-container="${s2.id}"]`);
        (s2.items || []).forEach(it => itemsContainer.appendChild(itemRow(it, s2.id)));

        s2Box.querySelector(`[data-add-item="${s2.id}"]`).onclick = () => {
          itemsContainer.appendChild(itemRow({ id: null, title: '', content: '' }, s2.id));
        };

        s2Box.querySelector(`[data-del-sub2="${s2.id}"]`).onclick = async () => {
          if (!confirm('ลบหัวข้อย่อยนี้และรายการเอกสารข้างในทั้งหมดหรือไม่?')) return;
          await postDelete(API.sub2Del + '/' + s2.id);
          loadTree();
        };
      });

      s1Box.querySelector(`[data-add-sub2="${s1.id}"]`).onsubmit = async (e) => {
        e.preventDefault();
        await postForm(API.sub2Save, { sub1_id: s1.id, name: e.target.name.value });
        loadTree();
      };
      s1Box.querySelector(`[data-del-sub1="${s1.id}"]`).onclick = async () => {
        if (!confirm('ลบหัวข้อย่อยนี้และข้อมูลข้างในทั้งหมดหรือไม่?')) return;
        await postDelete(API.sub1Del + '/' + s1.id);
        loadTree();
      };
    });

    catCard.querySelector(`[data-add-sub1="${cat.id}"]`).onsubmit = async (e) => {
      e.preventDefault();
      await postForm(API.sub1Save, { category_id: cat.id, name: e.target.name.value });
      loadTree();
    };
    catCard.querySelector(`[data-del-cat="${cat.id}"]`).onclick = async () => {
      if (!confirm('ลบหมวดหมู่นี้ทั้งหมดหรือไม่? (จะลบหัวข้อย่อยและรายการเอกสารข้างในด้วย)')) return;
      await postDelete(API.catDel + '/' + cat.id);
      loadTree();
    };
  });
}

// แถวของ "รายการเอกสาร" ที่แก้ไขข้อความได้โดยตรง (แทนการแนบไฟล์เดิม)
function itemRow(item, sub2Id) {
  const row = el('div', 'border border-gray-200 rounded-lg p-2 bg-gray-50');
  row.innerHTML = `
    <div class="flex gap-2 mb-1">
      <input class="border border-gray-200 rounded px-2 py-1 text-xs flex-1" placeholder="ชื่อรายการเอกสาร"
             value="${item.title || ''}" data-field="title">
      ${item.id ? `<a class="text-xs text-gray-500 hover:text-gray-700" href="${API.itemHistory}/${item.id}"><i class="fa-solid fa-clock-rotate-left mr-1"></i>ประวัติ</a>` : ''}
      <button class="text-xs text-red-500 hover:text-red-700" data-del-item>ลบ</button>
    </div>
    <textarea class="border border-gray-200 rounded px-2 py-1 text-xs w-full" rows="3"
              placeholder="พิมพ์ข้อความเอกสารตรงนี้..." data-field="content">${item.content || ''}</textarea>
    <div class="flex justify-end mt-1">
      <button class="text-xs bg-indigo-600 hover:bg-indigo-500 text-white px-3 py-1 rounded" data-save-item>บันทึก</button>
    </div>
  `;
  row.querySelector('[data-save-item]').onclick = async () => {
    const title = row.querySelector('[data-field="title"]').value;
    const content = row.querySelector('[data-field="content"]').value;
    const res = await postForm(API.itemSave, { id: item.id, sub2_id: sub2Id, title, content });
    if (res.status === 'ok') { item.id = res.id; alert('บันทึกแล้ว'); }
    else alert('เกิดข้อผิดพลาด: ' + (res.message || ''));
  };
  row.querySelector('[data-del-item]').onclick = async () => {
    if (!item.id) { row.remove(); return; }
    if (!confirm('ลบรายการนี้หรือไม่?')) return;
    await postDelete(API.itemDel + '/' + item.id);
    row.remove();
  };
  return row;
}

document.getElementById('catForm').onsubmit = async (e) => {
  e.preventDefault();
  const f = e.target;
  await postForm(API.catSave, { name: f.name.value, icon: f.icon.value });
  f.reset();
  loadTree();
};

loadTree();
</script>
