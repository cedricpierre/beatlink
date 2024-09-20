export function useStyleProps() {
    return {
        variant: {
            type: String,
            required: false,
        },
        size: {
            type: String,
            default: 'md',
            required: false,
            validator(value: string,): boolean {
                return ['xs', 'sm', 'md', 'lg'].includes(value);
            }
        },
        rounded: {
            type: String,
            default: 'md',
            validator(value: string,): boolean {
                return ['xs', 'sm', 'md', 'lg'].includes(value);
            }
        },
        className: {
            type: Array,
            default: [],
            required: false,
        },

    }
}
