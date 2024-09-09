<script lang="ts">
export function useStyleProps() {
    return {
        variant: {
            type: String,
            default: 'neutral',
            validator(value: string,): boolean {
                return ['neutral', 'accent', 'ghost', 'primary', 'secondary', 'error', 'success'].includes(value);
            }
        },
        size: {
            type: String,
            default: null,
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
