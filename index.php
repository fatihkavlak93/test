<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roaft Sipariş Formu</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --secondary: #f1f5f9;
            --text-dark: #1e293b;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --danger: #ef4444;
            --danger-hover: #dc2626;
            --bg-color: #f8fafc;
        }

        body { 
            font-family: 'Inter', sans-serif; 
            background-color: var(--bg-color); 
            color: var(--text-dark); 
            margin: 0; 
            padding: 40px 20px; 
            line-height: 1.6;
        }

        .container { 
            max-width: 850px; 
            margin: 0 auto; 
            background: #ffffff; 
            padding: 40px; 
            border-radius: 12px; 
            box-shadow: 0 4px 20px rgba(0,0,0,0.04), 0 1px 3px rgba(0,0,0,0.08); 
        }

        .header-text { text-align: center; margin-bottom: 30px; }
        .header-text h2 { color: var(--text-dark); font-size: 28px; font-weight: 700; margin-bottom: 5px; }
        .header-text p { color: var(--text-muted); font-size: 15px; margin-top: 0; }

        .section-title {
            font-size: 18px; font-weight: 600; margin-bottom: 15px; padding-bottom: 8px;
            border-bottom: 2px solid var(--secondary); color: var(--text-dark); margin-top: 30px;
        }

        .form-group { margin-bottom: 20px; }
        .form-row { display: flex; gap: 20px; }
        .form-row .form-group { flex: 1; margin-bottom: 0; }

        label { display: block; margin-bottom: 6px; font-weight: 500; font-size: 14px; color: var(--text-dark); }

        input[type="text"], input[type="tel"], input[type="number"], select, textarea {
            width: 100%; padding: 12px 14px; border: 1px solid var(--border); border-radius: 8px; 
            box-sizing: border-box; font-size: 15px; font-family: 'Inter', sans-serif; background-color: #fff; transition: all 0.3s ease;
        }

        input:focus, select:focus, textarea:focus {
            outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .file-drop-zone {
            border: 2px dashed #cbd5e1; padding: 30px 20px; text-align: center; border-radius: 8px; 
            background: var(--secondary); cursor: pointer; transition: all 0.3s ease; position: relative;
        }
        .file-drop-zone:hover { border-color: var(--primary); background: #e0e7ff; }
        .file-drop-zone input[type="file"] {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;
        }
        .file-drop-zone p { margin: 0; font-size: 15px; color: var(--text-dark); font-weight: 500; }
        .file-drop-zone small { color: var(--text-muted); display: block; margin-top: 5px; }

        #file-list { margin-top: 15px; display: flex; flex-direction: column; gap: 8px; }

        .file-item {
            display: flex; align-items: center; justify-content: space-between; background: #f8fafc;
            border: 1px solid var(--border); padding: 10px 14px; border-radius: 6px; font-size: 14px;
        }
        .file-info { display: flex; align-items: center; gap: 10px; overflow: hidden; flex: 1; }
        .file-name { font-weight: 500; color: var(--text-dark); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 250px;}
        .file-size { color: var(--text-muted); font-size: 12px; }
        
        .file-position-badge {
            background-color: #e0e7ff; color: var(--primary); padding: 4px 10px; border-radius: 12px;
            font-size: 12px; font-weight: 600; white-space: nowrap; margin-left: auto; margin-right: 15px;
        }

        .btn-file-delete {
            background: #fee2e2; color: var(--danger); border: none; width: 28px; height: 28px;
            border-radius: 4px; cursor: pointer; font-weight: bold; display: flex; align-items: center;
            justify-content: center; transition: background 0.2s; flex-shrink: 0;
        }
        .btn-file-delete:hover { background: var(--danger); color: white; }

        .oyuncu-satir { 
            display: flex; gap: 12px; margin-bottom: 12px; align-items: flex-end; 
            background: var(--secondary); padding: 15px; border-radius: 8px;
        }
        .oyuncu-satir .form-group { margin-bottom: 0; flex: 1; }
        .action-col { width: 40px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }

        .btn-delete {
            background-color: #fee2e2; color: var(--danger); border: none; width: 38px; height: 45px;
            border-radius: 6px; cursor: pointer; font-weight: bold; display: flex; align-items: center; justify-content: center; transition: all 0.2s;
        }
        .btn-delete:hover { background-color: var(--danger); color: white; }

        .btn-secondary { 
            background-color: #e2e8f0; color: var(--text-dark); border: none; padding: 10px 18px; 
            border-radius: 6px; cursor: pointer; font-weight: 500; font-size: 14px; transition: background 0.3s ease;
        }
        .btn-secondary:hover { background-color: #cbd5e1; }

        .btn-primary { 
            background-color: var(--primary); color: white; border: none; padding: 16px; width: 100%; 
            border-radius: 8px; font-size: 16px; cursor: pointer; font-weight: 600; margin-top: 20px;
            transition: background 0.3s ease; box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.2);
        }
        .btn-primary:hover { background-color: var(--primary-hover); transform: translateY(-1px); }

        .hint { color: var(--text-muted); font-size: 13px; margin-top: 6px; display: block; }

        /* --- Modal CSS Başlangıcı --- */
        .modal-overlay {
            display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(15, 23, 42, 0.6); z-index: 1000; align-items: center; justify-content: center;
            backdrop-filter: blur(4px);
        }
        .modal-content {
            background: white; padding: 30px; border-radius: 12px; width: 90%; max-width: 650px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1); max-height: 90vh; overflow-y: auto;
        }
        .modal-header { margin-bottom: 25px; text-align: center; }
        .modal-header h3 { margin: 0 0 10px 0; color: var(--text-dark); font-size: 22px; }
        .modal-header p { margin: 0; color: var(--text-muted); font-size: 15px; }
        #currentFileName { color: var(--primary); background: #eff6ff; padding: 4px 8px; border-radius: 4px; word-break: break-all; }
        
        .modal-grid {
            display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 15px;
        }
        .position-card {
            border: 1px solid var(--border); border-radius: 8px; padding: 20px 10px; cursor: pointer;
            text-align: center; transition: all 0.2s; background: white;
        }
        .position-card:hover { border-color: var(--primary); background: #f8fafc; box-shadow: 0 4px 6px rgba(0,0,0,0.05); transform: translateY(-2px); }
        .position-card span { display: block; margin-top: 15px; font-size: 14px; font-weight: 500; color: var(--text-dark); }
        
        .modal-footer { margin-top: 25px; text-align: center; }
        .btn-skip { background: transparent; color: var(--text-muted); border: 1px solid var(--border); padding: 8px 16px; border-radius: 6px; cursor: pointer; font-size: 14px; transition: all 0.2s; }
        .btn-skip:hover { background: var(--secondary); color: var(--text-dark); }

        /* Formadaki logoyu temsil eden basit SVG çizimleri */
        .shirt-svg { margin: 0 auto; display: block; }
        
        @media (max-width: 600px) {
            .container { padding: 25px 15px; }
            .form-row { flex-direction: column; gap: 15px; }
            .oyuncu-satir { flex-direction: column; align-items: stretch; gap: 10px; }
            .action-col { width: 100%; justify-content: flex-end; }
            .btn-delete { width: 100%; height: 38px; }
            .modal-grid { grid-template-columns: repeat(2, 1fr); }
            .modal-content { padding: 20px; }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header-text">
        <h2>Roaft Sipariş Formu</h2>
        <p>Hayalinizdeki formayı gerçeğe dönüştürmek için detayları bizimle paylaşın.</p>
    </div>
    
    <form action="siparis-kaydet.php" method="POST" id="siparisFormu" enctype="multipart/form-data">
        
        <!-- Müşterinin geldiği ürün sayfasını yakalamak için gizli input -->
        <input type="hidden" name="gelen_sayfa" id="gelen_sayfa" value="">

        <div class="section-title">İletişim Bilgileriniz</div>
        <div class="form-row">
            <div class="form-group">
                <label>Sipariş No veya Ad-Soyad *</label>
                <input type="text" name="musteri_adi" required placeholder="Örn: Fatih Kavlak">
            </div>
            <div class="form-group">
                <label>Telefon Numaranız *</label>
                <input type="tel" name="telefon" required placeholder="05XX XXX XX XX">
            </div>
        </div>

        <div class="section-title">Tasarım Detayları</div>
        <div class="form-group">
            <label>Logolarınız (Arma, Sponsor, İsim vb.)</label>
            <div class="file-drop-zone">
                <!-- Buradaki file input gizli tutuluyor, JS ile yönetilecek -->
                <input type="file" name="logolar[]" multiple id="file-input">
                <p id="file-text">Dosyaları Seçmek İçin Tıklayın veya Sürükleyin</p>
                <small>Önerilen formatlar: .png, .ai, .pdf, .cdr, .xls (Oyuncu listesi için)</small>
            </div>
            
            <!-- Seçilen Dosyaların Listesi -->
            <div id="file-list"></div>
            
            <!-- Arka plana gidecek olan gizli konum verilerini tutacak alan -->
            <div id="hidden-inputs-container"></div>
            
            <span class="hint">20 MB üstü logolarınızı wetransfer ile info@roaft.com adresine gönderebilirsiniz.</span>
        </div>

        <div class="form-group">
            <label>Tasarımınızı Özelleştirin</label>
            <textarea name="ozellestirme_notu" rows="4" placeholder="Formanın ana rengi siyah, yaka ve kol detayları sarı olsun. Logomuz sol göğüste yer alacak..."></textarea>
            <span class="hint">Tasarım ekibimizin bilmesi gereken tüm detayları buraya yazabilirsiniz.</span>
        </div>

        <div class="section-title">Oyuncu Listesi</div>
        <div id="oyuncu-container">
            <!-- 1. Satır (Sabit) -->
            <div class="oyuncu-satir">
                <div class="form-group"><label>Mevki</label><select name="mevki[]"><option value="Oyuncu">Oyuncu</option><option value="Kaleci">Kaleci</option><option value="Defans">Defans</option><option value="Orta Saha">Orta Saha</option><option value="Forvet">Forvet</option></select></div>
                <div class="form-group"><label>İsim</label><input type="text" name="isim[]" placeholder="Forma Arkası İsim"></div>
                <div class="form-group"><label>Numara</label><input type="number" name="numara[]" placeholder="Örn: 10"></div>
                <div class="form-group"><label>Beden</label><select name="beden[]"><option value="">Seçiniz</option><option value="S">S</option><option value="M">M</option><option value="L">L</option><option value="XL">XL</option><option value="XXL">XXL</option></select></div>
                <div class="action-col"></div>
            </div>
            <!-- 2. Satır -->
            <div class="oyuncu-satir"><div class="form-group"><label>Mevki</label><select name="mevki[]"><option value="Oyuncu">Oyuncu</option><option value="Kaleci">Kaleci</option></select></div><div class="form-group"><label>İsim</label><input type="text" name="isim[]" placeholder="Forma Arkası İsim"></div><div class="form-group"><label>Numara</label><input type="number" name="numara[]" placeholder="Örn: 10"></div><div class="form-group"><label>Beden</label><select name="beden[]"><option value="">Seçiniz</option><option value="S">S</option><option value="M">M</option></select></div><div class="action-col"><button type="button" class="btn-delete" title="Oyuncuyu Sil" onclick="oyuncuSil(this)">✕</button></div></div>
            <!-- 3. Satır -->
            <div class="oyuncu-satir"><div class="form-group"><label>Mevki</label><select name="mevki[]"><option value="Oyuncu">Oyuncu</option><option value="Kaleci">Kaleci</option></select></div><div class="form-group"><label>İsim</label><input type="text" name="isim[]" placeholder="Forma Arkası İsim"></div><div class="form-group"><label>Numara</label><input type="number" name="numara[]" placeholder="Örn: 10"></div><div class="form-group"><label>Beden</label><select name="beden[]"><option value="">Seçiniz</option><option value="S">S</option><option value="M">M</option></select></div><div class="action-col"><button type="button" class="btn-delete" title="Oyuncuyu Sil" onclick="oyuncuSil(this)">✕</button></div></div>
            <!-- 4. Satır -->
            <div class="oyuncu-satir"><div class="form-group"><label>Mevki</label><select name="mevki[]"><option value="Oyuncu">Oyuncu</option><option value="Kaleci">Kaleci</option></select></div><div class="form-group"><label>İsim</label><input type="text" name="isim[]" placeholder="Forma Arkası İsim"></div><div class="form-group"><label>Numara</label><input type="number" name="numara[]" placeholder="Örn: 10"></div><div class="form-group"><label>Beden</label><select name="beden[]"><option value="">Seçiniz</option><option value="S">S</option><option value="M">M</option></select></div><div class="action-col"><button type="button" class="btn-delete" title="Oyuncuyu Sil" onclick="oyuncuSil(this)">✕</button></div></div>
            <!-- 5. Satır -->
            <div class="oyuncu-satir"><div class="form-group"><label>Mevki</label><select name="mevki[]"><option value="Oyuncu">Oyuncu</option><option value="Kaleci">Kaleci</option></select></div><div class="form-group"><label>İsim</label><input type="text" name="isim[]" placeholder="Forma Arkası İsim"></div><div class="form-group"><label>Numara</label><input type="number" name="numara[]" placeholder="Örn: 10"></div><div class="form-group"><label>Beden</label><select name="beden[]"><option value="">Seçiniz</option><option value="S">S</option><option value="M">M</option></select></div><div class="action-col"><button type="button" class="btn-delete" title="Oyuncuyu Sil" onclick="oyuncuSil(this)">✕</button></div></div>
        </div>

        <button type="button" id="oyuncu-ekle-btn" class="btn-secondary">+ Yeni Oyuncu Ekle</button>
        <button type="submit" class="btn-primary">Siparişi Tamamla ve Gönder</button>
    </form>
</div>

<!-- Logo Konumu Seçim Modalı -->
<div id="logoModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Standart bir konum seçin</h3>
            <p><span id="currentFileName">logo.png</span> dosyası forma üzerinde nereye yerleştirilsin?</p>
        </div>
        
        <div class="modal-grid">
            <!-- Sol Göğüs (Arma) -->
            <div class="position-card" data-pos="Sol Göğüs (Arma)">
                <svg class="shirt-svg" viewBox="0 0 100 100" width="80" height="80">
                    <path d="M 25 10 C 25 10, 40 20, 50 20 C 60 20, 75 10, 75 10 L 95 30 L 80 40 L 80 90 L 20 90 L 20 40 L 5 30 Z" fill="#f1f5f9" stroke="#cbd5e1" stroke-width="2"/>
                    <rect x="62" y="32" width="12" height="12" fill="#334155" />
                </svg>
                <span>Sol Göğüs (Arma)</span>
            </div>

            <!-- Sağ Göğüs (Küçük Sponsor) -->
            <div class="position-card" data-pos="Sağ Göğüs (Sponsor)">
                <svg class="shirt-svg" viewBox="0 0 100 100" width="80" height="80">
                    <path d="M 25 10 C 25 10, 40 20, 50 20 C 60 20, 75 10, 75 10 L 95 30 L 80 40 L 80 90 L 20 90 L 20 40 L 5 30 Z" fill="#f1f5f9" stroke="#cbd5e1" stroke-width="2"/>
                    <rect x="26" y="32" width="12" height="12" fill="#334155" />
                </svg>
                <span>Sağ Göğüs (Sponsor)</span>
            </div>

            <!-- Göğüs Ortası (Küçük) -->
            <div class="position-card" data-pos="Göğüs Ortası (Küçük)">
                <svg class="shirt-svg" viewBox="0 0 100 100" width="80" height="80">
                    <path d="M 25 10 C 25 10, 40 20, 50 20 C 60 20, 75 10, 75 10 L 95 30 L 80 40 L 80 90 L 20 90 L 20 40 L 5 30 Z" fill="#f1f5f9" stroke="#cbd5e1" stroke-width="2"/>
                    <rect x="42" y="32" width="16" height="12" fill="#334155" />
                </svg>
                <span>Göğüs Ortası (Küçük)</span>
            </div>

            <!-- Göğüs Ortası (Ana Sponsor) -->
            <div class="position-card" data-pos="Göğüs Ortası (Ana Sponsor)">
                <svg class="shirt-svg" viewBox="0 0 100 100" width="80" height="80">
                    <path d="M 25 10 C 25 10, 40 20, 50 20 C 60 20, 75 10, 75 10 L 95 30 L 80 40 L 80 90 L 20 90 L 20 40 L 5 30 Z" fill="#f1f5f9" stroke="#cbd5e1" stroke-width="2"/>
                    <rect x="30" y="50" width="40" height="14" fill="#334155" />
                </svg>
                <span>Göğüs Ortası (Ana)</span>
            </div>

            <!-- Göğüs Altı (Sponsor) -->
            <div class="position-card" data-pos="Göğüs Altı (Sponsor)">
                <svg class="shirt-svg" viewBox="0 0 100 100" width="80" height="80">
                    <path d="M 25 10 C 25 10, 40 20, 50 20 C 60 20, 75 10, 75 10 L 95 30 L 80 40 L 80 90 L 20 90 L 20 40 L 5 30 Z" fill="#f1f5f9" stroke="#cbd5e1" stroke-width="2"/>
                    <rect x="30" y="70" width="40" height="14" fill="#334155" />
                </svg>
                <span>Göğüs Altı (Sponsor)</span>
            </div>

            <!-- Sırt Üst / Ense -->
            <div class="position-card" data-pos="Sırt (Numara Üstü)">
                <svg class="shirt-svg" viewBox="0 0 100 100" width="80" height="80">
                    <path d="M 25 10 L 75 10 L 95 30 L 80 40 L 80 90 L 20 90 L 20 40 L 5 30 Z" fill="#e2e8f0" stroke="#94a3b8" stroke-width="2"/>
                    <rect x="35" y="25" width="30" height="10" fill="#334155" />
                </svg>
                <span>Sırt (Numara Üstü)</span>
            </div>
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn-skip" id="btnSkipPosition">Özel Konum / Kararsızım</button>
        </div>
    </div>
</div>

<script>
    // Sayfa yüklendiğinde yönlendiren linki (referrer) yakala
    document.addEventListener("DOMContentLoaded", function() {
        let referrerUrl = document.referrer;
        if(referrerUrl) {
            document.getElementById('gelen_sayfa').value = referrerUrl;
        } else {
            document.getElementById('gelen_sayfa').value = "Doğrudan Giriş / Bilinmiyor";
        }
    });

    // Gelişmiş Dosya Yönetimi ve Konum Seçimi
    let selectedItems = []; // İçerik: { file: File, position: string }
    let positionQueue = []; // Konum seçimi bekleyen görsel dosyalarının sırası

    const fileInput = document.getElementById('file-input');
    const modal = document.getElementById('logoModal');
    const currentFileNameSpan = document.getElementById('currentFileName');

    fileInput.addEventListener('change', function(e) {
        const files = this.files;
        
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const ext = file.name.split('.').pop().toLowerCase();
            
            // Excel ve metin belgeleri için modal açma, direkt ekle
            if (['xls', 'xlsx', 'csv', 'txt', 'doc', 'docx'].includes(ext)) {
                selectedItems.push({ file: file, position: 'Oyuncu Listesi / Belge' });
            } else {
                // Diğerleri (png, jpg, ai, cdr, pdf vb.) için konum sorulmak üzere sıraya al
                positionQueue.push(file);
            }
        }
        
        this.value = ''; // Input'u sıfırla ki aynı dosya tekrar seçilebilsin
        processQueue(); // Sıradaki dosya için modalı başlat
    });

    // Kuyruktaki dosyaları sırayla işleyen fonksiyon
    function processQueue() {
        if (positionQueue.length > 0) {
            const currentFile = positionQueue[0];
            currentFileNameSpan.innerText = currentFile.name;
            modal.style.display = 'flex';
        } else {
            // Sırada dosya kalmadıysa listeyi ekrana çiz
            renderFileList();
        }
    }

    // Modal içerisindeki bir konuma tıklandığında
    document.querySelectorAll('.position-card').forEach(card => {
        card.addEventListener('click', function() {
            const selectedPosition = this.getAttribute('data-pos');
            const processedFile = positionQueue.shift(); // İşlenen dosyayı kuyruktan çıkar
            
            selectedItems.push({ file: processedFile, position: selectedPosition });
            
            modal.style.display = 'none';
            processQueue(); // Varsa sıradaki diğer dosya için pencereyi tekrar aç
        });
    });

    // Konum belirtmek istemiyorum butonuna basıldığında
    document.getElementById('btnSkipPosition').addEventListener('click', function() {
        const processedFile = positionQueue.shift();
        selectedItems.push({ file: processedFile, position: 'Belirtilmedi' });
        
        modal.style.display = 'none';
        processQueue();
    });

    // Dosyaları Listeleme ve Gizli Inputları Oluşturma
    function renderFileList() {
        const fileListContainer = document.getElementById('file-list');
        const hiddenInputsContainer = document.getElementById('hidden-inputs-container');
        
        fileListContainer.innerHTML = '';
        hiddenInputsContainer.innerHTML = '';
        
        if (selectedItems.length > 0) {
            document.getElementById('file-text').innerHTML = `<span style="color:var(--primary)">${selectedItems.length} adet dosya eklendi. Daha fazla ekleyebilirsiniz.</span>`;
        } else {
            document.getElementById('file-text').innerHTML = 'Dosyaları Seçmek İçin Tıklayın veya Sürükleyin';
        }

        // Form submit edilebilmesi için DataTransfer objesi oluşturuyoruz
        const dataTransfer = new DataTransfer();

        selectedItems.forEach((item, index) => {
            const file = item.file;
            dataTransfer.items.add(file);
            
            // UI Listesi için
            const fileItem = document.createElement('div');
            fileItem.className = 'file-item';
            
            let fileSize = file.size > 1024 * 1024 
                ? (file.size / (1024 * 1024)).toFixed(1) + ' MB' 
                : (file.size / 1024).toFixed(1) + ' KB';

            // Rozet (Badge) rengi - belge ise gri, konum ise mavi
            const badgeBg = item.position.includes('Belge') ? '#f1f5f9' : '#e0e7ff';
            const badgeColor = item.position.includes('Belge') ? '#64748b' : 'var(--primary)';

            fileItem.innerHTML = `
                <div class="file-info">
                    <span class="file-name" title="${file.name}">${file.name}</span>
                    <span class="file-size">(${fileSize})</span>
                </div>
                <span class="file-position-badge" style="background:${badgeBg}; color:${badgeColor}">${item.position}</span>
                <button type="button" class="btn-file-delete" title="Dosyayı Kaldır" data-index="${index}">✕</button>
            `;
            fileListContainer.appendChild(fileItem);

            // Sunucuya iletilecek Gizli Inputlar (Dosya Adı : Konum eşleştirmesi)
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = `logo_konumlari[${file.name}]`; // Post edildiğinde PHP'den $_POST['logo_konumlari']['dosya.png'] olarak alınabilir
            hiddenInput.value = item.position;
            hiddenInputsContainer.appendChild(hiddenInput);
        });

        // Orijinal file input'a seçilen dosyaları ata ki form gönderildiğinde dosyalar da gitsin
        fileInput.files = dataTransfer.files;

        // Silme İşlemleri
        document.querySelectorAll('.btn-file-delete').forEach(button => {
            button.addEventListener('click', function() {
                const indexToRemove = parseInt(this.getAttribute('data-index'));
                selectedItems.splice(indexToRemove, 1); // Array'den çıkar
                renderFileList(); // Listeyi güncelle
            });
        });
    }

    // Ortak Oyuncu Silme Fonksiyonu
    window.oyuncuSil = function(btn) {
        btn.closest('.oyuncu-satir').remove();
    };

    // Dinamik Oyuncu Ekleme
    document.getElementById('oyuncu-ekle-btn').addEventListener('click', function() {
        const container = document.getElementById('oyuncu-container');
        const ilkSatir = container.querySelector('.oyuncu-satir');
        const yeniSatir = ilkSatir.cloneNode(true);
        
        yeniSatir.querySelectorAll('input').forEach(input => input.value = '');
        yeniSatir.querySelectorAll('select').forEach(select => select.selectedIndex = 0);
        
        const actionCol = yeniSatir.querySelector('.action-col');
        actionCol.innerHTML = '';
        
        const deleteBtn = document.createElement('button');
        deleteBtn.type = 'button';
        deleteBtn.className = 'btn-delete';
        deleteBtn.innerHTML = '✕';
        deleteBtn.title = 'Oyuncuyu Sil';
        deleteBtn.onclick = function() { container.removeChild(yeniSatir); };
        
        actionCol.appendChild(deleteBtn);
        container.appendChild(yeniSatir);
    });
</script>

</body>
</html>