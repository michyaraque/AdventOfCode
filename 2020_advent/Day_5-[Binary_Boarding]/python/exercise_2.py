input = open('input_data.txt', 'r')

def str_arr_replace(phrase, char_to_replace):
    for key, value in char_to_replace.items():
        phrase = phrase.replace(key, value)
    return phrase

airplane = [['.' for i in range(8)] for i in range(128)]
row = 0
col = 0
i = 0

for seat in input:
    board_data = str_arr_replace(seat, {'F':'0', 'B':'1', 'L':'0', 'R':'1'})
    board_row = int(board_data[:7], 2)
    board_col = int(board_data[7:10], 2)
    airplane[board_row][board_col] = '#'

while i <= 127 * 8:
    if(row >= 10 and row <= 80 and col <= 7):
        if airplane[row][col] is not '#':
            seat_id = row * 8 + col
            print("[AVAILABLE SEAT]: [Row: {} | Col: {} >> Seat ID: {}]".format(row, col, seat_id))

    if(row % 127 == 0):
        row = 0
        col += 1
    row +=  1
    i += 1

#Result 597