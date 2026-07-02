<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * สร้างไฟล์ .docx (Word) แบบขั้นต่ำโดยไม่พึ่งไลบรารีภายนอก
 * ใช้ ZipArchive ที่มากับ PHP ประกอบ OOXML ตรงตามสเปกของ Word
 */
class Simple_docx {

    public static function build($title, $content)
    {
        $body  = self::paragraph(self::escape($title), true);
        $body .= '<w:p/>';

        $lines = preg_split('/\r\n|\r|\n/', (string) $content);
        foreach ($lines as $line) {
            $body .= self::paragraph(self::escape($line), false);
        }

        $documentXml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            . '<w:document xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main">'
            . '<w:body>' . $body
            . '<w:sectPr><w:pgSz w:w="11906" w:h="16838"/><w:pgMar w:top="1440" w:right="1440" w:bottom="1440" w:left="1440"/></w:sectPr>'
            . '</w:body></w:document>';

        $contentTypes = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            . '<Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types">'
            . '<Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml"/>'
            . '<Default Extension="xml" ContentType="application/xml"/>'
            . '<Override PartName="/word/document.xml" ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.document.main+xml"/>'
            . '</Types>';

        $rootRels = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'
            . '<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">'
            . '<Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="word/document.xml"/>'
            . '</Relationships>';

        // sys_get_temp_dir() ไม่สามารถเขียนได้จาก process ของเว็บเซิร์ฟเวอร์บนบางเครื่อง (เช่น XAMPP บน macOS)
        // ใช้โฟลเดอร์ temp ของ PHP เอง (upload_tmp_dir/session.save_path) ที่ยืนยันแล้วว่าเขียนได้จริง
        $tmpDir  = ini_get('upload_tmp_dir') ?: sys_get_temp_dir();
        $tmpFile = tempnam($tmpDir, 'docx');
        $zip     = new ZipArchive();
        $zip->open($tmpFile, ZipArchive::OVERWRITE);
        $zip->addFromString('[Content_Types].xml', $contentTypes);
        $zip->addFromString('_rels/.rels', $rootRels);
        $zip->addFromString('word/document.xml', $documentXml);
        $zip->close();

        $bytes = file_get_contents($tmpFile);
        unlink($tmpFile);

        return $bytes;
    }

    private static function paragraph($text, $bold)
    {
        $rPr = $bold ? '<w:rPr><w:b/><w:sz w:val="28"/></w:rPr>' : '';
        return '<w:p><w:r>' . $rPr . '<w:t xml:space="preserve">' . $text . '</w:t></w:r></w:p>';
    }

    private static function escape($text)
    {
        return htmlspecialchars((string) $text, ENT_XML1 | ENT_QUOTES, 'UTF-8');
    }
}
