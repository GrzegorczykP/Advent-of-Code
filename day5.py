def get_tickets():
    lines = open('data/day5.txt').readlines()
    tickets = []
    for line in lines:
        seat_id = 0
        line = line.strip()
        for c in line:
            seat_id <<= 1
            if c in 'BR':
                seat_id += 1
        tickets.append(seat_id)

    return tickets


if __name__ == '__main__':
    t = get_tickets()

    # Part I
    print(max(t))

    # Part II
    for i in range(min(t), max(t)):
        if i not in t:
            print(i)
            break
