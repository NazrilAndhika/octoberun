import re

with open('resources/views/user/home.blade.php', 'r', encoding='utf-8') as f:
    content = f.read()

# Replace text-[#e85d04] with text-white on h3
content = re.sub(r'<h3 class="(.*?text-\[#e85d04\].*?)">', lambda m: '<h3 class="' + m.group(1).replace('text-[#e85d04]', 'text-white') + '">', content)

# Replace text-blue-200 with text-white on p
content = re.sub(r'<p class="(.*?text-blue-200.*?)">', lambda m: '<p class="' + m.group(1).replace('text-blue-200', 'text-white') + '">', content)

# For h3s that don't have text-white yet (like Tanggal, Lokasi, dll), add text-white
content = re.sub(r'<h3 class="(.*?leading-(?:tight|none)(?!.*text-white).*?)">', lambda m: '<h3 class="' + m.group(1) + ' text-white">', content)

# Replace star icon with dot
star_svg = r'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-\[#e85d04\] shrink-0 opacity-80"><path fill-rule="evenodd" d="M10.788 3.21c\.448-1\.077 1\.976-1\.077 2\.424 0l2\.082 5\.006 5\.404\.434c1\.164\.093 1\.636 1\.545\.749 2\.305l-4\.117 3\.527 1\.257 5\.273c\.271 1\.136-\.964 2\.033-1\.96 1\.425L12 18\.354 7\.373 21\.18c-\.996\.608-2\.231-\.29-1\.96-1\.425l1\.257-5\.273-4\.117-3\.527c-\.887-\.76-\.415-2\.212\.749-2\.305l5\.404-\.434 2\.082-5\.005Z" clip-rule="evenodd" /></svg>'
content = re.sub(star_svg, '<span class="text-3xl text-orange-400 opacity-90 leading-none">&bull;</span>', content)

with open('resources/views/user/home.blade.php', 'w', encoding='utf-8') as f:
    f.write(content)
print('Done!')
