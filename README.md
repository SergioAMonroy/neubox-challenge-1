# neubox-challenge-1
Primer challenge - decodificación de archivos
Éste proyecto se encarga de leer un archivo, y entregar el resultado en otro archivo.

El archivo de entrada tiene las siguientes características:
-El archivo de entrada tendrá cuatro líneas, de las cuales:
  -La primer línea contará con tres elementos: M1, M2 y N.
    -M1 y M2 es el número de caracteres de las dos instrucciones.
    -N es el número de caracteres en el mensaje.
    -N siempre estará entre 3 y 5000.
    -M1 y M2 estarán entre 2 y 50.
  -La segunda línea contiene la primera instrucción.
  -La tercer línea contiene la segunda instrucción.
  -La cuarta línea contiene el mensaje y los caracteres posibles en el mensaje son [a-zA-Z0-9].
  
El archivo de salida tendrá las siguientes características:
  *Tendrá dos salidas.
  *La primer línea tendrá un SI si la primer instrucción se encuentra escondida en el mensaje o un NO de lo contrario.
  *La segunda línea tendrá un SI si la segunda instrucción se encuentra escondida en el mensaje o un no de lo contrario.
  
Ejemplo de archivo de entrada:
'''
11 15 38
CeseAlFuego
CorranACubierto
XXcaaamakkCCessseAAllFueeegooDLLKmmNNN
'''

Ejemplo de archivos de salida:
'''
SI
NO
'''
