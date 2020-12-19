def find_number():
    numbers = list(map(int, open('input.txt').readlines()))
    for i in numbers:
        for j in numbers:
            if i + j == 2020:
                return i * j


def find_3number():
    numbers = list(map(int, open('input.txt').readlines()))
    for i in numbers:
        for j in numbers:
            for k in numbers:
                if i + j + k == 2020:
                    return i * j * k


if __name__ == '__main__':
    print(find_number())
    print(find_3number())
