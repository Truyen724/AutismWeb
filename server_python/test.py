from detect_autism import AutismDetect
at = AutismDetect()

import cv2
img = cv2.imread('image/20.jpg')
img2, pred = at.atism_detect(img)
cv2.imshow("test", img2)
cv2.waitKey(0)
cv2.destroyAllWindows()
