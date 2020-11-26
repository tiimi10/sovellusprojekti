
import sys

input = str(sys.argv[1].strip())
output = bytearray.fromhex(input).decode()
print(output)
