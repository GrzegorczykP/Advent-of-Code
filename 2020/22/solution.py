def combat_sim(a, b, recursive=False, depth=0):
    configs = set()

    while len(a) and len(b):
        a0, b0 = a.pop(0), b.pop(0)
        curr = (tuple(a), tuple(b))
        if curr in configs:
            if depth == 0:
                if len(b):
                    a = b
                print(sum([x * (len(a) - i) for i, x in enumerate(a)]))
                return
            else:
                return True
        configs.add(curr)
        if recursive and a0 <= len(a) and b0 <= len(b):
            if combat_sim(a[:a0], b[:b0], True, depth + 1):
                a.extend([a0, b0])
            else:
                b.extend([b0, a0])
        elif a0 > b0:
            a.extend([a0, b0])
        else:
            b.extend([b0, a0])
    else:
        if recursive and depth > 0:
            return len(a) > 0  # True if Player I won
        else:
            if len(b):
                a = b
            print(sum([x * (len(a) - i) for i, x in enumerate(a)]))


file = list(map(lambda x: x.strip(), open('input.txt')))
sep = file.index('Player 2:')
a = list(map(int, file[1:sep - 1]))
b = list(map(int, file[sep + 1:]))

# Part I
# combat_sim(a, b)

# Part II
combat_sim(a, b, True)
