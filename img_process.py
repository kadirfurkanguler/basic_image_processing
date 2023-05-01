from flask import Flask, request
import random
import string
import cv2 as cv
import os
import glob
from pathlib import Path
from flask_cors import CORS

app = Flask(__name__)
CORS(app)
@app.route("/")
def hello_world():
    return "<p>Hello, World!</p>"
@app.route('/upload', methods=['POST'])
def upload():
  file = request.files['image']
  rnd =  ''.join(random.choice( string.ascii_lowercase) for i in range(12))
  filename = "new_" + rnd
  path = "./images/" + filename + ".jpg"
  file.save(path)
  return return_response(data={"path":filename})



@app.route('/resize_image',methods=['POST'])
def resize_image():
  try:
    if request.method == 'POST':
     width = int(request.form['width'])
     height = int(request.form['height'])
     image = request.form['image']
     _image = cv.imread('images/'+ image + '.jpg')
     _resized_image = cv.resize(_image, (width, height), interpolation=cv.INTER_LANCZOS4 )
     resized_image_path = "edited/resized_" + image + ".jpg"
     cv.imwrite(resized_image_path, _resized_image)
     return return_response(data={"path":resized_image_path})
  except Exception as inst: 
    return return_response(data={"error": str(inst)}, status=500)
  


@app.route('/rotate_image',methods=['POST'])
def rotate_image():
  try:
    if request.method == 'POST':
      rotate = int(request.form['rotate'])
      image = request.form['image']
      _image = cv.imread('images/'+ image + '.jpg')
      rotate_mode = {
      0: cv.ROTATE_180,
      90: cv.ROTATE_90_CLOCKWISE,
      180: cv.ROTATE_180,
      270: cv.ROTATE_90_COUNTERCLOCKWISE
      }[rotate]
      _rotated_image = cv.rotate(_image, rotate_mode)
      rotated_image_path = "edited/rotated_" + image + ".jpg"
      cv.imwrite(rotated_image_path, _rotated_image)
      return return_response(data={"path":rotated_image_path})
  except Exception as inst: 
    return return_response(data={"error": str(inst)}, status=500)
  

@app.route('/flip_image',methods=['POST'])
def flip_image():
  try:
    if request.method == 'POST':
      flip = int(request.form['flip'])
      image = request.form['image']
      _image = cv.imread('images/'+ image + '.jpg')
      _flipped_image = cv.flip(_image, flip)
      flipped_image_path = "edited/flipped_" + image + ".jpg"
      cv.imwrite(flipped_image_path, _flipped_image)
      return return_response(data={"path":flipped_image_path})
  except Exception as inst: 
    return return_response(data={"error": str(inst)}, status=500)
  
@app.route('/crop_image',methods=['POST'])
def crop_image():
  try:
    if request.method == 'POST':
      x = int(request.form['x'])
      y = int(request.form['y'])
      w = int(request.form['w'])
      h = int(request.form['h'])
      image = request.form['image']
      _image = cv.imread('images/'+ image + '.jpg')
      _cropped_image = _image[y:y+h, x:x+w]
      cropped_image_path = "edited/cropped_" + image + ".jpg"
      cv.imwrite(cropped_image_path, _cropped_image)
      return return_response(data={"path":cropped_image_path})
  except Exception as inst: 
    return return_response(data={"error": str(inst)}, status=500)
  


def return_response(data = {}, status = 200):
  return {
    **data,
    "status": status
  }