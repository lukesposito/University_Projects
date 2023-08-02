import cv2
import glob
import os
from PIL import Image
from pathlib import Path
import face_recognition
import numpy as np 

for infile in glob.glob("/var/www/project/Face_recog/known_people/*.png"):
    im = Image.open(infile)
    im.save(infile);

f = open('file.txt', 'r')
screenshot = f.read();






# def apply_brightness_contrast(input_img, brightness = 0, contrast = 0):
#     if brightness != 0:
#         if brightness > 0:
#             shadow = brightness
#             highlight = 255

#         else:
#             shadow = 0
#             highlight = 255 + brightness
#         alpha_b = (highlight - shadow)/255
#         gamma_b = shadow

        

#         buf = cv2.addWeighted(input_img, alpha_b, input_img, 0, gamma_b)

#     else:

#         buf = input_img.copy()

#     if contrast != 0:

#         f = 131*(contrast + 127)/(127*(131-contrast))
#         alpha_c = f
#         gamma_c = 127*(1-f)

#         buf = cv2.addWeighted(buf, alpha_c, buf, 0, gamma_c)

#     return buf


#Recognize_image = face_recognition.load_image_file("/var/www/project/Face_recog/random_photos/"+screenshot+"")
#Recognize_image = cv2.imread("/var/www/project/Face_recog/random_photos/"+screenshot+"")
path = "/var/www/project/Face_recog/known_people/"
Recognize_image = cv2.imread("/var/www/project/Face_recog/random_photos/"+screenshot+"")
# OPPURE ---->  Recognize_image = face_recognition.load_image_file("/var/www/project/Face_recog/random_photos/"+screenshot+"")    
Recognize_encoding = face_recognition.face_encodings(Recognize_image)[0]
for img in glob.glob("/var/www/project/Face_recog/known_people/*.png"):
    cv_img = cv2.imread(img)
    image = Path(img).stem
    known_encoding = face_recognition.face_encodings(cv_img)[0]
    results = face_recognition.compare_faces([known_encoding], Recognize_encoding)
    face_distance = face_recognition.face_distance([known_encoding], Recognize_encoding)
    if results[0] == True or face_distance[0] <= 0.6:
        match = True 
        with open("user.txt", "w") as file:
            file.write(f"{image}")
            file.close()
            print(f"Match: {match}")  
            break
    else : 
        match = False

if match == False:
    print(f"Match: {match}")            

    # except (IndexError):
    #     print("Errore! Luce scarsa o volto non inquadrato correttamente...")
    #     s = 640
    #     s1= 480
    #     Recognize_image = cv2.resize(Recognize_image, (s,s1), 0, 0, cv2.INTER_AREA)

    #     font = cv2.FONT_HERSHEY_SIMPLEX

    #     fcolor = (0,0,0)

    #     blist = [64] # list of brightness values
    #     clist = [64] # list of contrast values

    #     out = np.zeros((s*2, s*3, 3), dtype = np.uint8)

    #     for i, b in enumerate(blist):

    #         c = clist[i]

    #         row = s*int(i/3)
    #         col = s*(i%3)

    #         out = apply_brightness_contrast(Recognize_image, b, c)
    #         msg = 'b %d' % b
    #         cv2.putText(out,msg,(row,col), font, .7, fcolor,1,cv2.LINE_AA)
    #         msg = 'c %d' % c
    #         cv2.putText(out,msg,(row,col), font, .7, fcolor,1,cv2.LINE_AA)



    #     cv2.imwrite("/var/www/project/Face_recog/random_photos/out1.png", out)
    #     i = 1






# hsv = cv2.cvtColor(Recognize_image, cv2.COLOR_BGR2HSV)
# h, s, v = cv2.split(hsv)
# lim = 255 - 30
# v[v > lim] = 255
# v[v <= lim] += 30
# final_hsv = cv2.merge((h, s, v))
# Recognize_image = cv2.cvtColor(final_hsv, cv2.COLOR_HSV2BGR)


# Intensity_Matrix = np.ones(Recognize_image.shape, dtype = "uint8") * 60
# brightened_image = cv2.add(Recognize_image, Intensity_Matrix)
# cv2.imwrite("/var/www/project/Face_recog/random_photos/screeeen.png", brightened_image)


