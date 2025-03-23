#!/bin/bash

# 获取所有运行中的 Docker 容器
CONTAINERS=$(docker ps --format "{{.Names}}")

# 遍历容器，筛选出包含 "fourgtv" 的容器
for CONTAINER in $CONTAINERS; do
    if [[ "$CONTAINER" == *"fourgtv"* ]]; then
        echo "检测到 fourgtv 容器: $CONTAINER"

        # 获取 Docker 容器的架构
        ARCH=$(docker exec "${CONTAINER}" uname -m)

        # 根据架构选择合适的文件和 URL
        if [[ "$ARCH" == "aarch64" ]]; then
            FILE="new_fourgtv.cpython-311-aarch64-linux-musl.so"
            URL="https://php.1832888.xyz/${FILE}"
        elif [[ "$ARCH" == "x86_64" ]]; then
            FILE="new_fourgtv.cpython-311-x86_64-linux-musl.so"
            URL="https://php.1832888.xyz/${FILE}"
        else
            echo "未知架构: ${ARCH}，无法选择合适的文件。"
            continue
        fi

        # 下载文件到临时目录
        echo "正在下载 ${FILE}..."
        curl -o "/tmp/${FILE}" "${URL}"

        # 将文件复制到 Docker 容器内部的指定路径
        echo "正在更新 ${FILE} 到容器 ${CONTAINER}..."
        docker cp "/tmp/${FILE}" "${CONTAINER}:/app/channel_play/${FILE}"

        # 删除临时文件
        rm "/tmp/${FILE}"

        # 重启 Docker 容器
        echo "重启 Docker 容器 ${CONTAINER}..."
        docker restart "${CONTAINER}"

        # 输出成功信息
        echo "文件 ${FILE} 更新成功，Docker 容器 ${CONTAINER} 已重启。"
    fi
done
