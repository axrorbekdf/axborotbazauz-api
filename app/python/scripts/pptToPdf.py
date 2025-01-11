import comtypes.client
import sys
import os

def change_extension(input_path):
    # Faylning kengaytmasini o'zgartirish
    file_name, ext = os.path.splitext(input_path)
    if ext.lower() == '.pptx':  # Agar kengaytma .pptx bo'lsa
        new_path = file_name + '.pdf'  # .pdf kengaytmasini qo'shish
        return new_path
    return None

def pptx_to_pdf(input_file, output_file):
    powerpoint = comtypes.client.CreateObject("PowerPoint.Application")
    powerpoint.Visible = 1  # PowerPoint'ni ko'rinadigan qilish (ixtiyoriy)
    
    # Faylni ochish
    presentation = powerpoint.Presentations.Open(input_file)
    
    # PDF formatiga saqlash
    presentation.SaveAs(output_file, 32)  # 32 - PDF formatini belgilovchi kod
    presentation.Close()
    powerpoint.Quit()

def main():
    args = sys.argv[1:]  # Birinchi element skript nomi bo'ladi

    # Foydalanish
    file_name, ext = os.path.splitext(args[0])
    input_file = file_name + ext  # PowerPoint faylining to'liq yo'li
    output_file = change_extension(args[0])  # PDF faylining to'liq yo'li

    pptx_to_pdf(input_file, output_file)

    # Argumentlarni olish
    print(f"Arguments received: {input_file} {output_file}")

if __name__ == "__main__":
    main()