import face_recognition

known_image_Luca= face_recognition.load_image_file("/var/www/project/Face_recog/known_people/Screenshot_3.png")
known_image_Cri= face_recognition.load_image_file("/var/www/project/Face_recog/known_people/Cristiano_Ronaldo1.png")
known_image_Leo= face_recognition.load_image_file("/var/www/project/Face_recog/known_people/Lionel_Messi.jpg")
Recognize_image = face_recognition.load_image_file("/var/www/project/Face_recog/random_photos/screenshot.png")

known_encoding_Luca = face_recognition.face_encodings(known_image_Luca)[0]
known_encoding_Cri = face_recognition.face_encodings(known_image_Cri)[0]
known_encoding_Leo = face_recognition.face_encodings(known_image_Leo)[0]
Recognize_encoding = face_recognition.face_encodings(Recognize_image)[0]

face_distance_1 = face_recognition.face_distance([known_encoding_Luca], Recognize_encoding)
face_distance_2 = face_recognition.face_distance([known_encoding_Cri], Recognize_encoding)
face_distance_3 = face_recognition.face_distance([known_encoding_Leo], Recognize_encoding)

if face_distance_1[0] <= 0.6 or face_distance_2[0] <= 0.6 or face_distance_3[0] <= 0.6:
    match = True
else : match = False

#print(str(matching()))
#print("Range Distanza: [0.0 - 1.0]")
#print(f"L'immagine testata ha una distanza di {face_distance[0]:.2} dall'immagine conosciuta")
print(f"Match: {match}")