<script lang="ts">
export function useStyleProps() {
    return {
        variant: {
            type: String,
            default: 'neutral',
            required: false,
            validator(value: string,): boolean {
                return ['neutral', 'accent', 'ghost', 'primary', 'secondary', 'error', 'success'].includes(value);
            }
        },
        size: {
            type: String,
            default: 'md',
            required: false,
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
</script>
