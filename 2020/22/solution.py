def combat_sim(a, b):
    if len(a) and len(b):
        a0, b0 = a.pop(0), b.pop(0)
        if a0 > b0:
            a.extend([a0, b0])
        else:
            b.extend([b0, a0])
        combat_sim(a, b)
    else:
        if len(b):
            a = b
        len_ = len(a)
        print(sum([x * (len_ - i) for i, x in enumerate(a)]))


file = list(map(lambda x: x.strip(), open('input.txt')))
sep = file.index('Player 2:')
a = list(map(int, file[1:sep - 1]))
b = list(map(int, file[sep + 1:]))

# Part I
combat_sim(a, b)
