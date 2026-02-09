from PIL import Image

# Open the logo
img_path = 'public/images/logo-pekanbaru.png'
print(f"Opening {img_path}")

try:
    img = Image.open(img_path)
    
    # Get original size
    w, h = img.size
    print(f"Original size: {w}x{h}")
    
    # Calculate square size based on the largest dimension
    s = max(w, h)
    
    # Create new transparent square image
    new_img = Image.new('RGBA', (s, s), (0, 0, 0, 0))
    
    # Calculate offset to center the logo
    offset = ((s - w) // 2, (s - h) // 2)
    
    # Paste original logo onto the transparent square
    new_img.paste(img, offset)
    
    # Save the full-size square favicon
    new_img.save('public/images/logo-favicon.png')
    print("Saved public/images/logo-favicon.png (original size square)")
    
    # Create a standard size favicon (192x192) for better browser handling
    if s > 192:
        small_img = new_img.resize((192, 192), Image.Resampling.LANCZOS)
        small_img.save('public/images/logo-favicon-192.png')
        print("Saved public/images/logo-favicon-192.png (192x192)")
    else:
        new_img.save('public/images/logo-favicon-192.png')
        print("Saved public/images/logo-favicon-192.png (original size < 192)")

except Exception as e:
    print(f"Error processing image: {e}")
