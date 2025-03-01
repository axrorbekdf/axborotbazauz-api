import comtypes.client
import sys
import os

def change_extension(input_path):
    # Faylning kengaytmasini o'zgartirish
    file_name, ext = os.path.splitext(input_path)
    if ext.lower() == '.docx' or ext.lower() == '.doc':  # Agar kengaytma .docx bo'lsa
        new_path = file_name + '.pdf'  # .pdf kengaytmasini qo'shish
        return new_path
    return None

def doc_to_pdf(input_path, output_path):
    word = comtypes.client.CreateObject('Word.Application')
    doc = word.Documents.Open(input_path)
    doc.SaveAs(output_path, FileFormat=17)  # 17 - PDF format kodi
    doc.Close()
    word.Quit()

def main():
    args = sys.argv[1:]  # Birinchi element skript nomi bo'ladi

    # Foydalanish
    file_name, ext = os.path.splitext(args[0])
    input_file = file_name + ext  # PowerPoint faylining to'liq yo'li
    output_file = change_extension(args[0])  # PDF faylining to'liq yo'li
    
    doc_to_pdf(input_file, output_file)

    # Argumentlarni olish
    print(f"Arguments received: {input_file} {output_file}")

if __name__ == "__main__":
    main()