import re

def check_requirements(array):
    requirements = ('byr', 'iyr', 'eyr', 'hgt', 'hcl', 'ecl', 'pid')
    for req in requirements:
        if req not in array:
            return False
    return True


def validate(dic):
    if not 1920 <= int(dic['byr']) <= 2002:
        return False
    if not 2010 <= int(dic['iyr']) <= 2020:
        return False
    if not 2020 <= int(dic['eyr']) <= 2030:
        return False
    if dic['ecl'] not in ('amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth'):
        return False
    if not re.match(r'^#[a-fA-F0-9]{6}$', dic['hcl']):
        return False
    if not re.match(r'^0\d{8}$|\d{9}$', dic['pid']):
        return False
    if not re.match(r'^((59|6\d|7[0-6])in)|((1[5-8]\d|19[0-3])cm)$', dic['hgt']):
        return False

    return True


def count_valid_passports():
    counter = 0
    lines = open('data/day4.txt').readlines()
    i = 0
    while i < len(lines):
        dic = {}
        while i < len(lines) and lines[i] != '\n':
            line = lines[i].split()
            for x in line:
                data = x.split(':')
                dic[data[0]] = data[1]
            i += 1
        else:
            i += 1
        if check_requirements(dic.keys()):
            counter += 1

    return counter


def count_valid_passports2():
    counter = 0
    lines = open('data/day4.txt').readlines()
    i = 0
    while i < len(lines):
        dic = {}
        while i < len(lines) and lines[i] != '\n':
            line = lines[i].split()
            for x in line:
                data = x.split(':')
                dic[data[0]] = data[1]
            i += 1
        else:
            i += 1
        if check_requirements(dic.keys()) and validate(dic):
            counter += 1

    return counter


if __name__ == '__main__':
    print(count_valid_passports())
    print(count_valid_passports2())
