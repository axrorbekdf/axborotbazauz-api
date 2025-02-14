import os
import sys
import subprocess

def change_extension(input_path):
    """ DOCX faylni PDF ga o'zgartirish uchun yangi fayl yo'lini yaratish """
    file_name, ext = os.path.splitext(input_path)
    if ext.lower() == '.docx':
        return file_name + '.pdf'
    return None

def doc_to_pdf(input_path, output_path):
    """ LibreOffice orqali DOCX faylni PDF formatiga o'tkazish """
    try:
        # subprocess.run(["libreoffice", "--headless", "-env:UserInstallation=file:///tmp/LibreOffice_Conversion_${USER}", "--convert-to", "pdf:writer_pdf_Export", input_path], check=True)
        subprocess.run(["unoconv", "-f", "pdf", input_path], check=True)
        print(f"Konvertatsiya muvaffaqiyatli bajarildi: {output_path}")
    except subprocess.CalledProcessError as e:
        print(f"Xatolik yuz berdi: {e}")
        sys.exit(1)

def main():
    if len(sys.argv) < 2:
        print("Foydalanish: python script.py file.docx")
        sys.exit(1)

    input_file = sys.argv[1]
    
    if not os.path.exists(input_file):
        print("Xatolik: Fayl topilmadi!")
        sys.exit(1)

    output_file = change_extension(input_file)
    
    if not output_file:
        print("Xatolik: Faqat .docx fayllarni PDF formatiga o‘tkazish mumkin.")
        sys.exit(1)

    doc_to_pdf(input_file, output_file)

if __name__ == "__main__":
    main()
