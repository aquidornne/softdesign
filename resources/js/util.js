exports.formateDateToUS = (value) => {
    if (value) {
        const dataSplit = value.split('-')
        return `${dataSplit[2]}/${dataSplit[1]}/${dataSplit[0]}`
    }
    return ''
}