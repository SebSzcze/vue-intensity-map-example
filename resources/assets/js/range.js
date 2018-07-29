import tinycolor from 'tinycolor2'

export default class {
    constructor(max, color, divider = 4) {
        this.max = max
        this.divider = divider
        if(this.max < divider) {
            this.divider = max
        }
        this.color = color
        this.min = Math.round(max / divider)
        this.ranges = []
        this.build()
    }

    build(){
        let i;
        for (i = 1; i <= this.divider; i++) {

            let ratio = i / this.divider;

            this.ranges.push(
                this.createRange(i)
            )

            // this.ranges.push({
            //     from: (i - 1) * this.min + 1,
            //     to: i == this.divider ? this.max : i * this.min,
            //     ratio,
            //     color: tinycolor(this.color).setAlpha(ratio)
            // })
        }
    }

    createRange(index){
        let text
        const from = (index - 1) * this.min + 1;
        const to = index == this.divider ? this.max : index * this.min;
        const ratio = index / this.divider;
        const color = tinycolor(this.color).setAlpha(ratio)

        const affix = to != from ? ` - ${to}` : '';
        const label = from + affix

        if(index == 1 || index == 2) {
           text = tinycolor(this.color).darken(10)
        }


        return {
            from, to, color, label, text
        }
    }

    get(number){
        return this.ranges.filter((item) => {
            return item.from <= number && item.to >= number;
            return item.from < number < item.to
        }).pop()
    }

}