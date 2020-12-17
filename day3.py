def count_trees():
    lines = open('data/day3.txt').readlines()
    counter = 0
    for index, line in enumerate(lines):
        if line[(index * 3) % 31] == '#':
            counter += 1

    return counter


def count_trees2():
    lines = open('data/day3.txt').readlines()
    multiply = 1
    counter = [0] * 5
    for i in range(len(lines)):
        if lines[i][i % 31] == '#':
            counter[0] += 1
        if lines[i][(i * 3) % 31] == '#':
            counter[1] += 1
        if lines[i][(i * 5) % 31] == '#':
            counter[2] += 1
        if lines[i][(i * 7) % 31] == '#':
            counter[3] += 1
        if i % 2 and lines[i][i % 31] == '#':
            counter[4] += 1

    for x in counter:
        multiply *= x

    return multiply


if __name__ == '__main__':
    print(count_trees())
    print(count_trees2())
