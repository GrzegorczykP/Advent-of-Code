with open('input.txt') as file:
    lines = list(map(lambda x: x.strip(), file))
    groups = '\n'.join(lines).split('\n\n')
    part1 = 0
    part2 = 0
    for group in groups:
        any_ = set()
        all_ = set()
        for i, person in enumerate(group.split('\n')):
            curr = set(list(person))
            if i == 0:
                any_ = curr
                all_ = curr
            else:
                any_ = any_.union(curr)
                all_ = all_.intersection(curr)
        part1 += len(any_)
        part2 += len(all_)
    print(part1)
    print(part2)
