def split_content(content):
    out = {}
    for bag in content.split(', '):
        data = bag.split()
        if data[0].isnumeric():
            out[f'{data[1]} {data[2]}'] = int(data[0])
    return out


with open('input.txt') as file:
    input_ = list(map(lambda x: x.strip().split(' bags contain '), file))
    bags = {bag: split_content(content)
            for bag, content in input_}

    # Part I
    counter = 0
    for bag in bags:
        all_colours = set()


        def get_all_colours(base_colour):
            for c in bags[base_colour]:
                all_colours.add(c)
                get_all_colours(c)


        get_all_colours(bag)
        if 'shiny gold' in all_colours:
            counter += 1
    print(counter)

    # Part II
    def count_inner_bags(base_colour):
        counter = 1
        for colour, quantity in bags[base_colour].items():
            counter += quantity * count_inner_bags(colour)
        return counter


    print(count_inner_bags('shiny gold') - 1)
