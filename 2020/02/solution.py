def count_valid_passwords():
    counter = 0
    lines = open('input.txt').readlines()
    for line in lines:
        data = line.split()
        numbers = list(map(int, data[0].split('-')))
        if numbers[0] <= data[2].count(data[1][0]) <= numbers[1]:
            counter += 1

    return counter


def count_valid_passwords2():
    counter = 0
    lines = open('input.txt').readlines()
    for line in lines:
        data = line.split()
        numbers = list(map(int, data[0].split('-')))
        if (data[2][numbers[0] - 1] == data[1][0]) ^ (data[2][numbers[1] - 1] == data[1][0]):
            counter += 1

    return counter


if __name__ == '__main__':
    print(count_valid_passwords())
    print(count_valid_passwords2())
