<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $to = "fatihkavlak93@gmail.com"; // Siparişlerin düşeceği e-posta adresi
    
    $musteri_adi = htmlspecialchars($_POST['musteri_adi'] ?? 'Belirtilmemiş');
    $telefon = htmlspecialchars($_POST['telefon'] ?? 'Belirtilmemiş');
    $ozellestirme_notu = htmlspecialchars($_POST['ozellestirme_notu'] ?? '');
    $gelen_sayfa = htmlspecialchars($_POST['gelen_sayfa'] ?? 'Bilinmiyor / Doğrudan Giriş');

    $subject = "Yeni Roaft Siparişi: " . $musteri_adi;

    $boundary = md5(time());

    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "From: info@roaft.com\r\n";
    $headers .= "Reply-To: info@roaft.com\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"{$boundary}\"\r\n";

    $body = "--{$boundary}\r\n";
    $body .= "Content-Type: text/html; charset=UTF-8\r\n";
    $body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";

    // --- LOGO KONUMLARI İÇİN HTML BLOĞU HAZIRLIĞI ---
    $logo_detaylari_html = "";
    if (isset($_POST['logo_konumlari']) && is_array($_POST['logo_konumlari']) && count($_POST['logo_konumlari']) > 0) {
        $logo_detaylari_html .= '
                <div style="margin-bottom: 25px;">
                    <h3 style="font-size: 15px; color: #475569; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Logo Yerleşim Detayları</h3>
                    <div style="border: 1px solid #e2e8f0; border-radius: 8px; overflow: hidden;">
                        <table style="width: 100%; border-collapse: collapse; font-size: 14px; background-color: #ffffff;">
                            <tbody>';
        
        foreach ($_POST['logo_konumlari'] as $dosyaAdi => $konum) {
            // PHP POST metodunda noktalı isimleri alt çizgiye çevirir, bunu görsel olarak düzeltiyoruz
            $temizDosyaAdi = htmlspecialchars(str_replace('_', '.', $dosyaAdi));
            $temizKonum = htmlspecialchars($konum);
            
            $logo_detaylari_html .= '
                                <tr>
                                    <td style="padding: 12px 15px; border-bottom: 1px solid #f1f5f9; font-weight: 600; color: #334155; width: 60%;">' . $temizDosyaAdi . '</td>
                                    <td style="padding: 12px 15px; border-bottom: 1px solid #f1f5f9; color: #2563eb; font-weight: bold; text-align: right; background-color: #f8fafc;">➔ ' . $temizKonum . '</td>
                                </tr>';
        }
        
        $logo_detaylari_html .= '
                            </tbody>
                        </table>
                    </div>
                </div>';
    }

    // --- ŞIK E-POSTA TASARIMI BAŞLANGICI ---
    $mesaj = '
    <div style="font-family: Arial, sans-serif; background-color: #f1f5f9; padding: 30px; margin: 0;">
        <div style="max-width: 650px; margin: 0 auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
            
            <div style="background-color: #1e293b; color: #ffffff; padding: 25px; text-align: center;">
                <h1 style="margin: 0; font-size: 22px; font-weight: 700; letter-spacing: 0.5px;">ROAFT SİPARİŞ BİLDİRİMİ</h1>
                <p style="margin: 5px 0 0 0; font-size: 13px; color: #94a3b8;">Yeni bir özel tasarım forma siparişi alındı.</p>
            </div>

            <div style="padding: 30px;">
                
                <div style="background-color: #f8fafc; border-left: 4px solid #2563eb; padding: 15px 20px; border-radius: 0 8px 8px 0; margin-bottom: 25px;">
                    <p style="margin: 0 0 8px 0; font-size: 15px; color: #1e293b;"><strong>Müşteri / Sipariş:</strong> ' . $musteri_adi . '</p>
                    <p style="margin: 0 0 8px 0; font-size: 15px; color: #1e293b;"><strong>İletişim (Telefon):</strong> <a href="tel:' . $telefon . '" style="color: #2563eb; text-decoration: none;">' . $telefon . '</a></p>
                    <p style="margin: 0; font-size: 14px; color: #475569; word-break: break-all;"><strong>Geldigi Ürün Sayfası:</strong> <a href="' . $gelen_sayfa . '" target="_blank" style="color: #2563eb; text-decoration: underline;">' . $gelen_sayfa . '</a></p>
                </div>';

    if (!empty($ozellestirme_notu)) {
        $mesaj .= '
                <div style="margin-bottom: 25px;">
                    <h3 style="font-size: 15px; color: #475569; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Tasarım / Özelleştirme Notu</h3>
                    <div style="background-color: #fffbeb; border: 1px solid #fef3c7; padding: 15px; border-radius: 8px; font-size: 14px; color: #92400e; line-height: 1.5;">
                        ' . nl2br($ozellestirme_notu) . '
                    </div>
                </div>';
    }

    // Logo detayları html bloğunu buraya ekliyoruz
    $mesaj .= $logo_detaylari_html;

    $mesaj .= '
                <h3 style="font-size: 15px; color: #475569; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.5px;">Oyuncu Listesi ve Detayları</h3>
                
                <table style="width: 100%; border-collapse: collapse; margin-bottom: 25px; font-size: 14px;">
                    <thead>
                        <tr style="background-color: #f1f5f9; color: #334155; text-align: left;">
                            <th style="padding: 12px; border-bottom: 2px solid #e2e8f0;">Mevki</th>
                            <th style="padding: 12px; border-bottom: 2px solid #e2e8f0;">İsim</th>
                            <th style="padding: 12px; border-bottom: 2px solid #e2e8f0; text-align: center;">No</th>
                            <th style="padding: 12px; border-bottom: 2px solid #e2e8f0; text-align: center;">Beden</th>
                        </tr>
                    </thead>
                    <tbody>';

    if (isset($_POST['isim'])) {
        for ($i = 0; $i < count($_POST['isim']); $i++) {
            if (!empty($_POST['isim'][$i])) {
                $mevki = htmlspecialchars($_POST['mevki'][$i] ?? '');
                $isim = htmlspecialchars($_POST['isim'][$i] ?? '');
                $numara = htmlspecialchars($_POST['numara'][$i] ?? '');
                $beden = htmlspecialchars($_POST['beden'][$i] ?? '');

                $bg_color = ($i % 2 == 0) ? '#ffffff' : '#f8fafc';

                $mesaj .= "<tr style='background-color: {$bg_color};'>
                    <td style='padding: 10px 12px; border-bottom: 1px solid #e2e8f0; color: #475569;'>{$mevki}</td>
                    <td style='padding: 10px 12px; border-bottom: 1px solid #e2e8f0; color: #1e293b; font-weight: 500;'>{$isim}</td>
                    <td style='padding: 10px 12px; border-bottom: 1px solid #e2e8f0; color: #1e293b; text-align: center; font-weight: bold;'>{$numara}</td>
                    <td style='padding: 10px 12px; border-bottom: 1px solid #e2e8f0; color: #2563eb; text-align: center; font-weight: bold;'>{$beden}</td>
                </tr>";
            }
        }
    }

    $mesaj .= '
                    </tbody>
                </table>

            </div>

            <div style="background-color: #f8fafc; padding: 15px; text-align: center; border-top: 1px solid #e2e8f0; color: #94a3b8; font-size: 12px;">
                Bu e-posta <strong style="color: #64748b;">roaft.com</strong> sipariş formu üzerinden otomatik olarak gönderilmiştir.
            </div>

        </div>
    </div>';

    $body .= $mesaj . "\r\n\r\n";

    // Dosya Ekleri
    if (isset($_FILES['logolar'])) {
        foreach ($_FILES['logolar']['tmp_name'] as $key => $tmp_name) {
            if (!empty($tmp_name)) {
                $file_name = $_FILES['logolar']['name'][$key];
                $file_size = $_FILES['logolar']['size'][$key];
                $file_type = $_FILES['logolar']['type'][$key];
                $content = chunk_split(base64_encode(file_get_contents($tmp_name)));

                $body .= "--{$boundary}\r\n";
                $body .= "Content-Type: {$file_type}; name=\"{$file_name}\"\r\n";
                $body .= "Content-Disposition: attachment; filename=\"{$file_name}\"\r\n";
                $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
                $body .= $content . "\r\n\r\n";
            }
        }
    }

    $body .= "--{$boundary}--";

    // Mail Gönderimi ve Başarı Ekranı (UI/UX Tasarımlı)
    if (mail($to, $subject, $body, $headers)) {
        // WhatsApp numarası
        $whatsapp_no = "905302833003"; 
        $whatsapp_mesaj = urlencode("Merhaba, Roaft üzerinden sipariş oluşturdum. Grafik çalışması için görüşmek istiyorum.");
        $whatsapp_link = "https://wa.me/{$whatsapp_no}?text={$whatsapp_mesaj}";

        echo '
        <!DOCTYPE html>
        <html lang="tr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Siparişiniz Alındı - Roaft</title>
            <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
            <style>
                body {
                    font-family: "Inter", sans-serif;
                    background-color: #f8fafc;
                    color: #1e293b;
                    margin: 0;
                    padding: 40px 20px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    min-height: 80vh;
                }
                .success-card {
                    background: #ffffff;
                    max-width: 550px;
                    width: 100%;
                    padding: 40px;
                    border-radius: 16px;
                    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
                    text-align: center;
                }
                .success-icon {
                    width: 70px;
                    height: 70px;
                    background-color: #dcfce7;
                    color: #16a34a;
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 32px;
                    margin: 0 auto 20px auto;
                }
                h2 {
                    font-size: 24px;
                    font-weight: 700;
                    color: #0f172a;
                    margin-bottom: 10px;
                }
                p {
                    color: #64748b;
                    font-size: 15px;
                    line-height: 1.6;
                    margin-bottom: 30px;
                }
                .btn-whatsapp {
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    gap: 10px;
                    background-color: #25d366;
                    color: white;
                    text-decoration: none;
                    padding: 16px 28px;
                    border-radius: 8px;
                    font-weight: 600;
                    font-size: 16px;
                    width: 100%;
                    box-sizing: border-box;
                    transition: background 0.3s ease, transform 0.2s ease;
                    box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);
                }
                .btn-whatsapp:hover {
                    background-color: #22c55e;
                    transform: translateY(-2px);
                }
            </style>
        </head>
        <body>
            <div class="success-card">
                <div class="success-icon">✓</div>
                <h2>Siparişiniz Başarıyla Alındı!</h2>
                <p>Tasarım ve oyuncu bilgileriniz ekibimize ulaştı. Tasarım sürecini hızlandırmak ve grafik ekibimizle birebir görüşmek için aşağıdaki butona tıklayarak hemen WhatsApp üzerinden iletişime geçebilirsiniz.</p>
                
                <a href="' . $whatsapp_link . '" target="_blank" class="btn-whatsapp">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                    Grafikere Bağlanmak İçin Tıklayın
                </a>
            </div>
        </body>
        </html>
        ';
    } else {
        echo "<div style='font-family:sans-serif; text-align:center; padding:50px;'><h2>Sipariş gönderilemedi.</h2><p>Lütfen daha sonra tekrar deneyiniz.</p></div>";
    }
}
?>