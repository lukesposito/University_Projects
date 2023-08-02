import cv2
import glob
import os
from PIL import Image
from pathlib import Path
import face_recognition 

for infile in glob.glob("/var/www/project/Face_recog/known_people/*.png"):
    im = Image.open(infile)
    im.save(infile);

f = open('file.txt', 'r')
screenshot = f.read();

Recognize_image = face_recognition.load_image_file("/var/www/project/Face_recog/random_photos/"+screenshot+"")
path = "/var/www/project/Face_recog/known_people/"
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
        print(f"Match: {match}")
        break