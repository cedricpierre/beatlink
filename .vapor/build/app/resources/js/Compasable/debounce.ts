export function useDebounce() {
    let timeoutId: number | undefined
    return (method: Function, delay: number = 1000) => {
        return ((...args: any[]) => {
            window.clearTimeout(timeoutId)
            timeoutId = window.setTimeout(() => {
                method.apply(null, args)
            }, delay)
        })(method);
    }
}
