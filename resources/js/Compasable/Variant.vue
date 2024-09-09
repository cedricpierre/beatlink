<script lang="ts">
import {defineProps} from 'vue'

export function useVariant() {
    const props = defineProps({
        variant: {
            type: String,
            default: 'neutral',
            validator(value: string,): boolean {
                return ['neutral', 'primary', 'secondary', 'error', 'success'].includes(value);
            }
        }
    })

    return props.variant
}
</script>
