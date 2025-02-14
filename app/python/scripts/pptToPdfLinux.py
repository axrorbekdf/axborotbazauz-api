import os
import sys
import subprocess

def change_extension(input_path):
    """ Fayl kengaytmasini .pdf ga o'zgartirish """
    file_name, ext = os.path.splitext(input_path)
    if ext.lower() == '.pptx':
        return file_name + '.pdf'
    return None

def pptx_to_pdf(input_file):
    """ LibreOffice yordamida PPTX faylni PDF formatiga o'tkazish """
    try:
        # subprocess.run(["libreoffice", "--headless", "-env:UserInstallation=file:///tmp/LibreOffice_Conversion_${USER}", "--convert-to", "pdf:writer_pdf_Export", input_file], check=True)
        subprocess.run(["unoconv", "-f", "pdf", input_file], check=True)
        print(f"Konvertatsiya muvaffaqiyatli bajarildi: {input_file} -> {change_extension(input_file)}")
    except subprocess.CalledProcessError as e:
        print(f"Xatolik yuz berdi: {e}")
        sys.exit(1)

def main():
    if len(sys.argv) < 2:
        print("Foydalanish: python script.py file.pptx")
        sys.exit(1)

    input_file = sys.argv[1]
    
    if not os.path.exists(input_file):
        print("Xatolik: Fayl topilmadi!")
        sys.exit(1)

    output_file = change_extension(input_file)
    
    if not output_file:
        print("Xatolik: Faqat .pptx fayllarni PDF formatiga o‘tkazish mumkin.")
        sys.exit(1)

    pptx_to_pdf(input_file)

if __name__ == "__main__":
    main()
