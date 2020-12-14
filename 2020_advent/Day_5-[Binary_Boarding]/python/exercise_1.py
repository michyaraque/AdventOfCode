input = open('input_data.txt', 'r')

def str_arr_replace(phrase, char_to_replace):
    for key, value in char_to_replace.items():
        phrase = phrase.replace(key, value)
    return phrase

boards = []
for seat in input:
    board_data = str_arr_replace(seat, {'F':'0', 'B':'1', 'L':'0', 'R':'1'})
    board_row = int(board_data[:7], 2)
    board_col = int(board_data[7:10], 2)
    board_seat_id = board_row * 8 + board_col
    boards.append(board_seat_id)

print(max(boards))

# Result 801